<?php
session_start();
require_once __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/cadastro.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$senha_confirm = $_POST['senha_confirm'] ?? '';

if (!$nome || !$email || !$senha || !$senha_confirm) {
    header('Location: ../pages/cadastro.php?error=Preencha+todos+os+campos');
    exit;
}

if ($senha !== $senha_confirm) {
    header('Location: ../pages/cadastro.php?error=Senhas+nao+conferem');
    exit;
}

$stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = :email LIMIT 1');
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
if ($stmt->fetch()) {
    header('Location: ../pages/cadastro.php?error=E-mail+ja+cadastrado');
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');
$stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':senha', $senhaHash, PDO::PARAM_STR);
$stmt->execute();

$userId = (int) $conn->lastInsertId();
$_SESSION['usuario_id'] = $userId;
$_SESSION['usuario_nome'] = $nome;
$_SESSION['usuario_email'] = $email;

header('Location: ../pages/dashboard.php');
exit;
