<?php
include_once '../../config/db.php';
include_once '../layout/header.php';
?>

<div class="container">
    <h2 class="mb-4"><i class="bi bi-bar-chart-fill"></i> Relatórios</h2>

    <div class="row g-4">
        <!-- Relatório 1 -->
        <div class="col-md-4">
            <a href="clientes_equipamentos.php" class="text-decoration-none">
                <div class="card text-white bg-primary h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="bi bi-people-fill display-4 mb-3"></i>
                        <h5 class="card-title text-center">Clientes e Equipamentos</h5>
                        <p class="text-center">Veja quais equipamentos estão vinculados a cada cliente.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Relatório 2 -->
        <div class="col-md-4">
            <a href="os_por_status.php" class="text-decoration-none">
                <div class="card text-white bg-warning h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="bi bi-clipboard-check-fill display-4 mb-3"></i>
                        <h5 class="card-title text-center">Ordens por Status</h5>
                        <p class="text-center">Relatório de ordens agrupadas por status.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Relatório 3 -->
        <div class="col-md-4">
            <a href="resumo_geral.php" class="text-decoration-none">
                <div class="card text-white bg-success h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="bi bi-graph-up-arrow display-4 mb-3"></i>
                        <h5 class="card-title text-center">Resumo Geral</h5>
                        <p class="text-center">Contagem total de clientes, equipamentos e ordens.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>
