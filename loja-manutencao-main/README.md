Aplicação simples, e funciona, com recursos como:
- Cadastro de clientes
- Cadastro de equipamentos
- Registro de ordens de serviço (OS)
- Controle de status das ordens
- Relatórios básicos

  loja-manutencao/
├── index.php
├── config/
│   └── db.php
├── controllers/
│   ├── ClienteController.php
│   ├── EquipamentoController.php
│   └── OrdemServicoController.php
├── models/
│   ├── Cliente.php
│   ├── Equipamento.php
│   └── OrdemServico.php
├── views/
│   ├── clientes/
│   ├── equipamentos/
│   └── ordens/
├── public/
│   └── css/
│       └── style.css
└── database/
    └── schema.sql
