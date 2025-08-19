<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja de Manutenção</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/loja-manutencao-main/public/css/style.css">
</head>
<body class="<?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/loja-manutencao-main/views/home.php">CEAD Manutenções</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/loja-manutencao-main/views/clientes/listar.php">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/loja-manutencao-main/views/equipamentos/listar.php">Equipamentos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/loja-manutencao-main/views/ordens/listar.php">Ordens de Serviço</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">
