<?php
include_once '../../config/db.php';
include_once '../../models/Cliente.php';
include_once '../layout/header.php';

$clienteModel = new Cliente($pdo);
$clientes = $clienteModel->listar();
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-hdd-fill"></i> Cadastrar Equipamento</h2>
    <a href="listar.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<form action="../../controllers/EquipamentoController.php" method="POST" class="row g-3">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="col-md-6">
        <label for="cliente_id" class="form-label">Cliente</label>
        <select name="cliente_id" id="cliente_id" class="form-select" required>
            <option value="">Selecione um cliente</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="tipo" class="form-label">Tipo</label>
        <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Ex: Notebook, Impressora..." required>
    </div>

    <div class="col-md-6">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" name="marca" id="marca" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label for="modelo" class="form-label">Modelo</label>
        <input type="text" name="modelo" id="modelo" class="form-control" required>
    </div>

    <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save-fill"></i> Cadastrar
        </button>
    </div>
</form>

<?php include_once '../layout/footer.php'; ?>
