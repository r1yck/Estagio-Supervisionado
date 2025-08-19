<?php
include_once '../../config/db.php';
include_once '../../models/OrdemServico.php';
include_once '../../models/Equipamento.php';
include_once '../layout/header.php';

// Verifica se veio um ID
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID da OS não informado.</div>";
    include_once '../layout/footer.php';
    exit;
}

$osModel = new OrdemServico($pdo);
$equipamentoModel = new Equipamento($pdo);

$os = $osModel->buscarPorId($_GET['id']);
$equipamentos = $equipamentoModel->listar();

if (!$os) {
    echo "<div class='alert alert-warning'>OS não encontrada.</div>";
    include_once '../layout/footer.php';
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-pencil-square"></i> Editar Ordem de Serviço</h2>
    <a href="listar.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<form action="../../controllers/OrdemServicoController.php" method="POST" class="row g-3">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?= htmlspecialchars($os['id']) ?>">

    <div class="col-md-6">
        <label for="equipamento_id" class="form-label">Equipamento</label>
        <select name="equipamento_id" id="equipamento_id" class="form-select" required>
            <?php foreach ($equipamentos as $eq): ?>
                <option value="<?= $eq['id'] ?>" <?= $eq['id'] == $os['equipamento_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($eq['tipo']) ?> - <?= htmlspecialchars($eq['cliente_nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <?php
            $statusOptions = ['Aberta', 'Em andamento', 'Concluída', 'Cancelada'];
            foreach ($statusOptions as $status):
            ?>
                <option value="<?= $status ?>" <?= $os['status'] == $status ? 'selected' : '' ?>>
                    <?= $status ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-12">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" rows="4" class="form-control" required><?= htmlspecialchars($os['descricao']) ?></textarea>
    </div>

    <div class="col-md-6">
        <label for="data_conclusao" class="form-label">Data de Conclusão</label>
        <input type="datetime-local" name="data_conclusao" id="data_conclusao" class="form-control"
               value="<?= $os['data_conclusao'] ? date('Y-m-d\TH:i', strtotime($os['data_conclusao'])) : '' ?>">
    </div>

    <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-lg"></i> Salvar Alterações
        </button>
    </div>
</form>

<?php include_once '../layout/footer.php'; ?>
