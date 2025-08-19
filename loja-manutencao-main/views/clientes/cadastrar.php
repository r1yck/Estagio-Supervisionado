<?php include_once '../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-person-plus-fill"></i> Cadastrar Cliente</h2>
    <a href="listar.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<form action="../../controllers/ClienteController.php" method="POST" class="row g-3">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="col-md-6">
        <label for="nome" class="form-label">Nome completo</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="tel" name="telefone" id="telefone" class="form-control" required placeholder="(00) 91234-5678">
    </div>

    <div class="col-md-12">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle-fill"></i> Salvar
        </button>
    </div>
</form>

<?php include_once '../layout/footer.php'; ?>
