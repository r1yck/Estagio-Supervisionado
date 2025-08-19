<?php
require_once __DIR__ . '/../models/Cliente.php';

require_once __DIR__ . '/../config/db.php';

$cliente = new Cliente($pdo);

// Pegando a ação que veio via POST
$acao = $_POST['acao'] ?? null;

if ($acao === 'cadastrar') {
    $cliente->adicionar($_POST['nome'], $_POST['telefone'], $_POST['email']);
    header('Location: ../views/clientes/listar.php');
    exit;
}

if ($acao === 'editar') {
    $cliente->atualizar($_POST['id'], $_POST['nome'], $_POST['telefone'], $_POST['email']);
    header('Location: ../views/clientes/listar.php');
    exit;
}

if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    if ($cliente->deletar($id)) {
        header('Location: ../views/clientes/listar.php?sucesso=1');
    } else {
        header('Location: ../views/clientes/listar.php?erro=1');
    }
    exit;
}

