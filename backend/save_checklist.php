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

$conn->exec("CREATE TABLE IF NOT EXISTS checklist_photos (
    id INT(11) NOT NULL AUTO_INCREMENT,
    checklist_item_id INT(11) NOT NULL,
    caminho VARCHAR(255) DEFAULT NULL,
    conteudo LONGBLOB DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY checklist_item_id (checklist_item_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

try {
    $conn->beginTransaction();

    $stmt = $conn->prepare('INSERT INTO checklists (criador, setor) VALUES (:criador, :setor)');
    $stmt->bindValue(':criador', $usuarioId, PDO::PARAM_INT);
    $stmt->bindValue(':setor', $setor, PDO::PARAM_STR);
    $stmt->execute();
    $reportId = (int) $conn->lastInsertId();

    $insertItemStmt = $conn->prepare('INSERT INTO checklist_items (checklist_id, campo, resposta, observacao) VALUES (:checklist_id, :campo, :resposta, :observacao)');
    $insertPhotoStmt = $conn->prepare('INSERT INTO checklist_photos (checklist_item_id, caminho, conteudo) VALUES (:item_id, :caminho, :conteudo)');

    for ($i = 1; $i <= 10; $i++) {
        $campo = 'p' . $i;
        $obsCampo = 'obs_p' . $i;
        $fotoCampo = 'foto_p' . $i;
        $resposta = $_POST[$campo] ?? 'nao-selecionado';
        $observacao = trim($_POST[$obsCampo] ?? '');

        $insertItemStmt->bindValue(':checklist_id', $reportId, PDO::PARAM_INT);
        $insertItemStmt->bindValue(':campo', $campo, PDO::PARAM_STR);
        $insertItemStmt->bindValue(':resposta', $resposta, PDO::PARAM_STR);
        $insertItemStmt->bindValue(':observacao', $observacao, PDO::PARAM_STR);
        $insertItemStmt->execute();
        $itemId = (int) $conn->lastInsertId();

        if (!empty($_FILES[$fotoCampo]['name'])) {
            $uploadDir = __DIR__ . '/../uploads/' . $setor;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $file = $_FILES[$fotoCampo];
            if ($file['error'] === UPLOAD_ERR_OK) {
                $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
                $nomeSeguro = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $originalName);
                $nomeArquivoWebp = sprintf('%s_%s_%s_%s.webp', $setor, $usuarioId, $campo, time());
                $destinoWebp = $uploadDir . '/' . $nomeArquivoWebp;
                $imageData = file_get_contents($file['tmp_name']);

                $savedPath = null;
                $savedBinary = null;

                // Try GD first
                if (function_exists('imagecreatefromstring') && function_exists('imagewebp')) {
                    $image = @imagecreatefromstring($imageData);
                    if ($image !== false) {
                        imagepalettetotruecolor($image);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                        if (imagewebp($image, $destinoWebp, 80)) {
                            imagedestroy($image);
                            $savedPath = 'uploads/' . $setor . '/' . $nomeArquivoWebp;
                            $savedBinary = file_get_contents($destinoWebp);
                        } else {
                            imagedestroy($image);
                        }
                    }
                }

                // If GD failed, try Imagick
                if ($savedBinary === null && class_exists('Imagick')) {
                    try {
                        $im = new Imagick($file['tmp_name']);
                        $im->setImageFormat('webp');
                        $im->setImageCompressionQuality(80);
                        $im->writeImage($destinoWebp);
                        $savedPath = 'uploads/' . $setor . '/' . $nomeArquivoWebp;
                        $savedBinary = file_get_contents($destinoWebp);
                        $im->clear();
                        $im->destroy();
                    } catch (Exception $e) {
                        // ignore and fallback
                    }
                }

                // Final fallback: move original file and store its bytes
                if ($savedBinary === null) {
                    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                    $nomeArquivo = sprintf('%s_%s_%s_%s.%s', $setor, $usuarioId, $campo, time(), $ext);
                    $destino = $uploadDir . '/' . $nomeArquivo;
                    if (move_uploaded_file($file['tmp_name'], $destino)) {
                        $savedPath = 'uploads/' . $setor . '/' . $nomeArquivo;
                        $savedBinary = file_get_contents($destino);
                    }
                }

                if ($savedPath !== null || $savedBinary !== null) {
                    $insertPhotoStmt->bindValue(':item_id', $itemId, PDO::PARAM_INT);
                    $insertPhotoStmt->bindValue(':caminho', $savedPath, PDO::PARAM_STR);
                    $insertPhotoStmt->bindValue(':conteudo', $savedBinary, PDO::PARAM_LOB);
                    $insertPhotoStmt->execute();
                }
            }
        }
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
