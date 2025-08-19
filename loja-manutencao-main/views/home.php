<?php include_once '../config/db.php'; ?>
<?php include_once 'layout/header.php'; ?>

<div class="text-center mb-5">

    <img src="/loja-manutencao-main/public/img/wrench.svg" 
         alt="Loja Manutenção" 
         class="img-fluid mx-auto d-block mb-4"
         style="max-width: 300px; filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.2));">

    <h1 class="fw-bold"><i class="bi bi-house-fill"></i> Bem-vindo à CEAD Manutenções</h1>
    <p class="lead">Gerencie seus clientes, equipamentos e ordens de serviço com praticidade.</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <a href="clientes/listar.php" class="text-decoration-none">
            <div class="card shadow h-100 text-center border-start border-4 border-primary">
                <div class="card-body">
                    <i class="bi bi-person-lines-fill display-4 text-primary"></i>
                    <h5 class="card-title mt-3">Clientes</h5>
                    <p class="text-muted">Gerencie os clientes da sua loja.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="equipamentos/listar.php" class="text-decoration-none">
            <div class="card shadow h-100 text-center border-start border-4 border-info">
                <div class="card-body">
                    <i class="bi bi-cpu-fill display-4 text-info"></i>
                    <h5 class="card-title mt-3">Equipamentos</h5>
                    <p class="text-muted">Veja e cadastre equipamentos vinculados.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="ordens/listar.php" class="text-decoration-none">
            <div class="card shadow h-100 text-center border-start border-4 border-success">
                <div class="card-body">
                    <i class="bi bi-tools display-4 text-success"></i>
                    <h5 class="card-title mt-3">Ordens de Serviço</h5>
                    <p class="text-muted">Registre, atualize e acompanhe ordens de manutenção.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-12">
        <a href="relatorios/index.php" class="text-decoration-none">
            <div class="card shadow h-100 text-center border-start border-4 border-warning mt-3">
                <div class="card-body">
                    <i class="bi bi-bar-chart-fill display-4 text-warning"></i>
                    <h5 class="card-title mt-3">Relatórios</h5>
                    <p class="text-muted">Acompanhe dados e estatísticas do sistema.</p>
                </div>
            </div>
        </a>
    </div>
</div>

<?php include_once 'layout/footer.php'; ?>
