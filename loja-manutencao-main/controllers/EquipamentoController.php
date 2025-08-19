<?php
require_once __DIR__ . '/../models/Equipamento.php';
require_once __DIR__ . '/../config/db.php';

$equipamento = new Equipamento($pdo);

$acao = $_POST['acao'] ?? null;

if ($acao === 'cadastrar') {
    $equipamento->adicionar(
        $_POST['cliente_id'],
        $_POST['tipo'],
        $_POST['marca'],
        $_POST['modelo']
    );
    header('Location: ../views/equipamentos/listar.php');
    exit;
}

if ($acao === 'editar') {
    $equipamento->atualizar(
        $_POST['id'],
        $_POST['cliente_id'],
        $_POST['tipo'],
        $_POST['marca'],
        $_POST['modelo']
    );
    header('Location: ../views/equipamentos/listar.php');
    exit;
}

if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    if ($equipamento->deletar($id)) {
        header('Location: ../views/equipamentos/listar.php?sucesso=1');
    } else {
        header('Location: ../views/equipamentos/listar.php?erro=1');
    }
    exit;
}

