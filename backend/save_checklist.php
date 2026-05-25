<?php
session_start();
require_once __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/dashboard.php');
    exit;
}

if (empty($_SESSION['usuario_id'])) {
    header('Location: ../pages/index.php');
    exit;
}

$usuarioId = (int) $_SESSION['usuario_id'];
$setor = trim($_POST['setor'] ?? '');
$allowedSetores = ['nr_06', 'nr_10', 'nr_23'];

if (!in_array($setor, $allowedSetores, true)) {
    header('Location: ../pages/dashboard.php?error=Setor+inválido');
    exit;
}

// Ensure normalized tables exist (safe to run every time)
$conn->exec("CREATE TABLE IF NOT EXISTS checklists (
    id INT(11) NOT NULL AUTO_INCREMENT,
    criador INT(11) NOT NULL,
    setor VARCHAR(20) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY criador (criador)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$conn->exec("CREATE TABLE IF NOT EXISTS checklist_items (
    id INT(11) NOT NULL AUTO_INCREMENT,
    checklist_id INT(11) NOT NULL,
    campo VARCHAR(20) NOT NULL,
    resposta ENUM('conforme','nao-conforme','nao-selecionado') NOT NULL DEFAULT 'nao-selecionado',
    observacao TEXT DEFAULT NULL,
    PRIMARY KEY (id),
    KEY checklist_id (checklist_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

try {
    $conn->beginTransaction();

    $stmt = $conn->prepare('INSERT INTO checklists (criador, setor) VALUES (:criador, :setor)');
    $stmt->bindValue(':criador', $usuarioId, PDO::PARAM_INT);
    $stmt->bindValue(':setor', $setor, PDO::PARAM_STR);
    $stmt->execute();
    $reportId = (int) $conn->lastInsertId();

    $insertItemStmt = $conn->prepare('INSERT INTO checklist_items (checklist_id, campo, resposta, observacao) VALUES (:checklist_id, :campo, :resposta, :observacao)');

    for ($i = 1; $i <= 10; $i++) {
        $campo = 'p' . $i;
        $obsCampo = 'obs_p' . $i;
        $resposta = $_POST[$campo] ?? 'nao-selecionado';
        $observacao = trim($_POST[$obsCampo] ?? '');

        $insertItemStmt->bindValue(':checklist_id', $reportId, PDO::PARAM_INT);
        $insertItemStmt->bindValue(':campo', $campo, PDO::PARAM_STR);
        $insertItemStmt->bindValue(':resposta', $resposta, PDO::PARAM_STR);
        $insertItemStmt->bindValue(':observacao', $observacao, PDO::PARAM_STR);
        $insertItemStmt->execute();
        $itemId = (int) $conn->lastInsertId();
    }

    $conn->commit();
    header('Location: ../pages/relatorio.php?id=' . $reportId);
    exit;

} catch (Exception $e) {
    $conn->rollBack();
    error_log('Erro ao salvar checklist: ' . $e->getMessage());
    header('Location: ../pages/dashboard.php?error=Erro+ao+salvar');
    exit;
}
