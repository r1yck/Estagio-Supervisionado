<?php
require_once __DIR__ . '/../models/OrdemServico.php';
require_once __DIR__ . '/../config/db.php';

$os = new OrdemServico($pdo);

$acao = $_POST['acao'] ?? null;

if ($acao === 'cadastrar') {
    $os->adicionar(
        $_POST['equipamento_id'],
        $_POST['descricao'],
        $_POST['status'],
        $_POST['data_conclusao'] ?? null
    );
    header('Location: ../views/ordens/listar.php');
    exit;
}

if ($acao === 'editar') {
    $os->atualizar(
        $_POST['id'],
        $_POST['equipamento_id'],
        $_POST['descricao'],
        $_POST['status'],
        $_POST['data_conclusao'] ?? null
    );
    header('Location: ../views/ordens/listar.php');
    exit;
}

if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    if ($os->deletar($id)) {
        header('Location: ../views/ordens/listar.php?sucesso=1');
    } else {
        header('Location: ../views/ordens/listar.php?erro=1');
    }
    exit;
}
