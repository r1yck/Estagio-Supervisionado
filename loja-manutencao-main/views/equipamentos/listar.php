<?php
include_once '../../config/db.php';
include_once '../../models/Equipamento.php';
include_once '../layout/header.php';

$equipamentoModel = new Equipamento($pdo);
$equipamentos = $equipamentoModel->listar();
?>

<?php if (isset($_GET['sucesso'])): ?>
    <div class="alert alert-success">
        Equipamento excluído com sucesso.
    </div>
<?php elseif (isset($_GET['erro'])): ?>
    <div class="alert alert-danger">
        Não foi possível excluir o equipamento. Existem ordens de serviço vinculadas a ele.
    </div>
<?php endif; ?>


<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-hdd-stack-fill"></i> Equipamentos</h2>
    <a href="cadastrar.php" class="btn btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Novo Equipamento
    </a>
</div>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($equipamentos) > 0): ?>
            <?php foreach ($equipamentos as $e): ?>
                <tr>
                    <td><?= $e['id'] ?></td>
                    <td><?= htmlspecialchars($e['cliente_nome']) ?></td>
                    <td><?= htmlspecialchars($e['tipo']) ?></td>
                    <td><?= htmlspecialchars($e['marca']) ?></td>
                    <td><?= htmlspecialchars($e['modelo']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="../../controllers/EquipamentoController.php?deletar=<?= $e['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir este equipamento?')">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Nenhum equipamento cadastrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include_once '../layout/footer.php'; ?>
