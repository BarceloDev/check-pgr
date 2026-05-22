<?php
session_start();

require_once __DIR__ . '/conexao.php';

function checkAuth(): void
{
    if (empty($_SESSION['usuario_id'])) {
        header('Location: ../pages/index.php');
        exit;
    }
}

function getUserName(): string
{
    return $_SESSION['usuario_nome'] ?? 'Usuário';
}

function getUserEmail(): string
{
    return $_SESSION['usuario_email'] ?? '';
}

function getCurrentUserId(): ?int
{
    return !empty($_SESSION['usuario_id']) ? (int) $_SESSION['usuario_id'] : null;
}
