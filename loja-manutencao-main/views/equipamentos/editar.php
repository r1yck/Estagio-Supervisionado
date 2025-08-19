<?php
include_once '../../config/db.php';
include_once '../../models/Equipamento.php';
include_once '../../models/Cliente.php';
include_once '../layout/header.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID do equipamento não informado.</div>";
    include_once '../layout/footer.php';
    exit;
}

$equipamentoModel = new Equipamento($pdo);
$clienteModel = new Cliente($pdo);

$equipamento = $equipamentoModel->buscarPorId($_GET['id']);
$clientes = $clienteModel->listar();

if (!$equipamento) {
    echo "<div class='alert alert-warning'>Equipamento não encontrado.</div>";
    include_once '../layout/footer.php';
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-pencil-square"></i> Editar Equipamento</h2>
    <a href="listar.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<form action="../../controllers/EquipamentoController.php" method="POST" class="row g-3">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?= htmlspecialchars($equipamento['id']) ?>">

    <div class="col-md-6">
        <label for="cliente_id" class="form-label">Cliente</label>
        <select name="cliente_id" id="cliente_id" class="form-select" required>
            <option value="">Selecione um cliente</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $c['id'] == $equipamento['cliente_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="tipo" class="form-label">Tipo</label>
        <input type="text" name="tipo" id="tipo" class="form-control"
               value="<?= htmlspecialchars($equipamento['tipo']) ?>" required>
    </div>

    <div class="col-md-6">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" name="marca" id="marca" class="form-control"
               value="<?= htmlspecialchars($equipamento['marca']) ?>" required>
    </div>

    <div class="col-md-6">
        <label for="modelo" class="form-label">Modelo</label>
        <input type="text" name="modelo" id="modelo" class="form-control"
               value="<?= htmlspecialchars($equipamento['modelo']) ?>" required>
    </div>

    <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-lg"></i> Salvar Alterações
        </button>
    </div>
</form>

<?php include_once '../layout/footer.php'; ?>
