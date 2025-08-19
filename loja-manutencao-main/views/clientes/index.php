<h2>Clientes</h2>
<a href="index.php?rota=novo_cliente">Novo Cliente</a>
<ul>
<?php foreach ($clientes as $cliente): ?>
    <li><?= $cliente['nome'] ?> - <?= $cliente['telefone'] ?></li>
<?php endforeach; ?>
</ul>