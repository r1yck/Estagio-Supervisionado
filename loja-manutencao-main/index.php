<?php
require_once 'config/db.php';
require_once 'controllers/ClienteController.php';

$rota = $_GET['rota'] ?? 'clientes';
$clienteController = new ClienteController($pdo);

switch ($rota) {
    case 'clientes':
        $clienteController->index();
        break;
    case 'salvar_cliente':
        $clienteController->salvar($_POST);
        break;
    default:
        echo "Rota não encontrada.";
}
?>