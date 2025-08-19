<?php
include_once '../../config/db.php';
include_once '../../models/OrdemServico.php';
include_once '../layout/header.php';

$ordemModel = new OrdemServico($pdo);
$ordens = $ordemModel->listar(); 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-ui-checks-grid"></i> Ordens de Serviço por Status</h2>
    <a href="index.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar aos Relatórios
    </a>
</div>

<?php
// Agrupando por status
$agrupadas = [];
foreach ($ordens as $os) {
    $agrupadas[$os['status']][] = $os;
}

$statusCores = [
    'Aberta' => 'secondary',
    'Em andamento' => 'warning',
    'Concluída' => 'success',
    'Cancelada' => 'danger'
];
?>

<?php foreach ($agrupadas as $status => $lista): ?>
    <div class="mb-4">
        <h4 class="text-<?= $statusCores[$status] ?? 'dark' ?>">
            <i class="bi bi-bookmark-fill"></i> <?= $status ?> (<?= count($lista) ?>)
        </h4>
        <div class="row g-3">
            <?php foreach ($lista as $os): ?>
                <div class="col-md-6">
                    <div class="card shadow-sm border-start border-4 border-<?= $statusCores[$status] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($os['cliente_nome']) ?> | <?= htmlspecialchars($os['equipamento_tipo']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($os['descricao'])) ?></p>
                            <p class="mb-0">
                                <strong>Abertura:</strong> <?= date('d/m/Y H:i', strtotime($os['data_abertura'])) ?><br>
                                <strong>Conclusão:</strong> <?= $os['data_conclusao'] ? date('d/m/Y H:i', strtotime($os['data_conclusao'])) : '-' ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<?php include_once '../layout/footer.php'; ?>
