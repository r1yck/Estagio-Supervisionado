<?php
include_once '../../config/db.php';
include_once '../../models/Cliente.php';
include_once '../../models/Equipamento.php';
include_once '../layout/header.php';

$clienteModel = new Cliente($pdo);
$equipamentoModel = new Equipamento($pdo);

$clientes = $clienteModel->listar();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-diagram-3-fill"></i> Clientes com seus Equipamentos</h2>
    <a href="index.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar aos Relatórios
    </a>
</div>

<?php foreach ($clientes as $cliente): ?>
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">
            <strong><?= htmlspecialchars($cliente['nome']) ?></strong> 
            <span class="float-end"><?= htmlspecialchars($cliente['telefone']) ?> | <?= htmlspecialchars($cliente['email']) ?></span>
        </div>
        <div class="card-body">
            <?php
                $equipamentos = $equipamentoModel->listarPorCliente($cliente['id']);
                if (count($equipamentos) > 0):
            ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($equipamentos as $eq): ?>
                        <li class="list-group-item">
                            <i class="bi bi-cpu-fill text-primary me-2"></i>
                            <strong>Tipo:</strong> <?= htmlspecialchars($eq['tipo']) ?> |
                            <strong>Marca:</strong> <?= htmlspecialchars($eq['marca']) ?> |
                            <strong>Modelo:</strong> <?= htmlspecialchars($eq['modelo']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted mb-0">Nenhum equipamento vinculado a este cliente.</p>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

<?php include_once '../layout/footer.php'; ?>
