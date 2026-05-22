<?php

$host = "localhost";
$banco = "checklistprg_db";
$usuario = "root";
$senha = "";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8",
        $usuario,
        $senha
    );

    // Configura modo de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

?>