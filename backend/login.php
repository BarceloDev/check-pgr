<?php
session_start();
require_once __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/index.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if (!$email || !$senha) {
    header('Location: ../pages/index.php?error=Informe+e-mail+e+senha');
    exit;
}

$stmt = $conn->prepare('SELECT id, nome, email, senha FROM usuarios WHERE email = :email LIMIT 1');
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    header('Location: ../pages/index.php?error=E-mail+ou+senha+inválidos');
    exit;
}

$_SESSION['usuario_id'] = (int) $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];
$_SESSION['usuario_email'] = $usuario['email'];

header('Location: ../pages/dashboard.php');
exit;
