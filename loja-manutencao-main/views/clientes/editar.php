<?php
include_once '../../config/db.php';
include_once '../../models/Cliente.php';
include_once '../layout/header.php';

// Verificar se o ID foi passado
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID do cliente não informado.</div>";
    include_once '../layout/footer.php';
    exit;
}

$clienteModel = new Cliente($pdo);
$cliente = $clienteModel->buscarPorId($_GET['id']);

if (!$cliente) {
    echo "<div class='alert alert-warning'>Cliente não encontrado.</div>";
    include_once '../layout/footer.php';
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-pencil-fill"></i> Editar Cliente</h2>
    <a href="listar.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<form action="../../controllers/ClienteController.php" method="POST" class="row g-3">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['id']) ?>">

    <div class="col-md-6">
        <label for="nome" class="form-label">Nome completo</label>
        <input type="text" name="nome" id="nome" class="form-control" required
               value="<?= htmlspecialchars($cliente['nome']) ?>">
    </div>

    <div class="col-md-6">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="tel" name="telefone" id="telefone" class="form-control" required
               value="<?= htmlspecialchars($cliente['telefone']) ?>">
    </div>

    <div class="col-md-12">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" required
               value="<?= htmlspecialchars($cliente['email']) ?>">
    </div>

    <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save-fill"></i> Salvar Alterações
        </button>
    </div>
</form>

<?php include_once '../layout/footer.php'; ?>
