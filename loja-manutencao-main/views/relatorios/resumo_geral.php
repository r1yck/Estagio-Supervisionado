<?php
include_once '../../config/db.php';
include_once '../../models/Cliente.php';
include_once '../../models/Equipamento.php';
include_once '../../models/OrdemServico.php';
include_once '../layout/header.php';

$clienteModel = new Cliente($pdo);
$equipamentoModel = new Equipamento($pdo);
$ordemModel = new OrdemServico($pdo);

$totalClientes = count($clienteModel->listar());
$totalEquipamentos = count($equipamentoModel->listar());
$totalOrdens = count($ordemModel->listar());
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Resumo Geral</h2>
    <a href="index.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar aos Relatórios
    </a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-people-fill display-4 mb-3"></i>
                <h5 class="card-title">Clientes</h5>
                <p class="card-text fs-4"><?= $totalClientes ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-info shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-hdd-network-fill display-4 mb-3"></i>
                <h5 class="card-title">Equipamentos</h5>
                <p class="card-text fs-4"><?= $totalEquipamentos ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-tools display-4 mb-3"></i>
                <h5 class="card-title">Ordens de Serviço</h5>
                <p class="card-text fs-4"><?= $totalOrdens ?></p>
            </div>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>
