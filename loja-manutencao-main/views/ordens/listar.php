<?php
include_once '../../config/db.php';
include_once '../../models/OrdemServico.php';
include_once '../layout/header.php';

$ordemModel = new OrdemServico($pdo);
$ordens = $ordemModel->listar();
?>

<?php if (isset($_GET['sucesso'])): ?>
    <div class="alert alert-success">
        Ordem de serviço excluída com sucesso.
    </div>
<?php elseif (isset($_GET['erro'])): ?>
    <div class="alert alert-danger">
        Não foi possível excluir a ordem de serviço. Ela pode estar vinculada a outros dados.
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-clipboard-data-fill"></i> Ordens de Serviço</h2>
    <a href="cadastrar.php" class="btn btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Nova OS
    </a>
</div>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Equipamento</th>
            <th>Status</th>
            <th>Abertura</th>
            <th>Conclusão</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($ordens) > 0): ?>
            <?php foreach ($ordens as $o): ?>
                <tr>
                    <td><?= $o['id'] ?></td>
                    <td><?= htmlspecialchars($o['cliente_nome']) ?></td>
                    <td><?= htmlspecialchars($o['equipamento_tipo']) ?></td>
                    <td>
                        <?php
                            $badge = match ($o['status']) {
                                'Aberta' => 'secondary',
                                'Em andamento' => 'warning',
                                'Concluída' => 'success',
                                'Cancelada' => 'danger',
                                default => 'light'
                            };
                        ?>
                        <span class="badge bg-<?= $badge ?>"><?= $o['status'] ?></span>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($o['data_abertura'])) ?></td>
                    <td>
                        <?= $o['data_conclusao'] ? date('d/m/Y H:i', strtotime($o['data_conclusao'])) : '-' ?>
                    </td>
                    <td>
                        <a href="editar.php?id=<?= $o['id'] ?>" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="../../controllers/OrdemServicoController.php?deletar=<?= $o['id'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Deseja excluir esta OS?')">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">Nenhuma OS cadastrada.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include_once '../layout/footer.php'; ?>
