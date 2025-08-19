<?php
include_once '../../config/db.php';
include_once '../../models/Equipamento.php';
include_once '../../models/Cliente.php';
include_once '../layout/header.php';

$equipamentoModel = new Equipamento($pdo);
$equipamentos = $equipamentoModel->listar();
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-clipboard-plus-fill"></i> Nova Ordem de Serviço</h2>
    <a href="listar.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<form action="../../controllers/OrdemServicoController.php" method="POST" class="row g-3">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="col-md-6">
        <label for="equipamento_id" class="form-label">Equipamento</label>
        <select name="equipamento_id" id="equipamento_id" class="form-select" required>
            <option value="">Selecione um equipamento</option>
            <?php foreach ($equipamentos as $eq): ?>
                <option value="<?= $eq['id'] ?>">
                    <?= htmlspecialchars($eq['tipo']) ?> - <?= htmlspecialchars($eq['cliente_nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="Aberta">Aberta</option>
            <option value="Em andamento">Em andamento</option>
            <option value="Concluída">Concluída</option>
            <option value="Cancelada">Cancelada</option>
        </select>
    </div>

    <div class="col-md-12">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" rows="4" class="form-control" placeholder="Descreva o problema ou serviço a ser realizado" required></textarea>
    </div>

    <div class="col-md-6">
        <label for="data_conclusao" class="form-label">Data de Conclusão (opcional)</label>
        <input type="datetime-local" name="data_conclusao" id="data_conclusao" class="form-control">
    </div>

    <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save-fill"></i> Cadastrar Ordem
        </button>
    </div>
</form>

<?php include_once '../layout/footer.php'; ?>
