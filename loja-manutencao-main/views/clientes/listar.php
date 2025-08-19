<?php
include_once '../../config/db.php';
include_once '../../models/Cliente.php';
include_once '../layout/header.php';

$cliente = new Cliente($pdo);
$clientes = $cliente->listar();
?>

<?php if (isset($_GET['sucesso'])): ?>
    <div class="alert alert-success">
        Cliente excluído com sucesso.
    </div>
<?php elseif (isset($_GET['erro'])): ?>
    <div class="alert alert-danger">
        Não foi possível excluir o cliente. Existem equipamentos vinculados a ele.
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-people-fill"></i> Clientes</h2>
    <a href="cadastrar.php" class="btn btn-primary">
        <i class="bi bi-person-plus-fill"></i> Novo Cliente
    </a>
</div>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($clientes) > 0): ?>
            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['id']) ?></td>
                    <td><?= htmlspecialchars($c['nome']) ?></td>
                    <td><?= htmlspecialchars($c['telefone']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="../../controllers/ClienteController.php?deletar=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Nenhum cliente cadastrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include_once '../layout/footer.php'; ?>
