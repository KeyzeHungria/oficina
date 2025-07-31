<?php
   session_start();
   if (!isset($_SESSION["usuario_id"]))
     header("location:login.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Menu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    .navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
      color: #cccccc !important; /* cor básica cinza claro */
    }

    .navbar-nav {
      width: 100%;
      display: flex;
      flex-wrap: wrap; /* permite quebrar em múltiplas linhas */
      justify-content: center;
      gap: 0.75rem; /* espaçamento entre os links */
    }

    .nav-link {
      font-weight: 600;
      color: #cccccc !important;
      padding: 0.25rem 0.75rem;
    }

    .nav-link:hover {
      color: #fd0dfd6b !important; /* azul no hover */
      background-color: transparent !important;
    }

    /* Espaçamento para o texto do usuário e botão logout */
    .navbar-text {
      white-space: nowrap;
    }
  </style>
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">
    <div class="container">
      <a class="navbar-brand" href="index.php">Oficina Mecânica</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#menuNav"
        aria-controls="menuNav"
        aria-expanded="false"
        aria-label="Alternar navegação"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menuNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="usuario.php">Usuário</a></li>
          <li class="nav-item"><a class="nav-link" href="cliente.php">Cliente</a></li>
          <li class="nav-item"><a class="nav-link" href="funcionario.php">Funcionário</a></li>
          <li class="nav-item"><a class="nav-link" href="agendamento.php">Agendamento</a></li>
          <li class="nav-item"><a class="nav-link" href="veiculo.php">Veículo</a></li>
          <li class="nav-item"><a class="nav-link" href="pagamento.php">Pagamento</a></li>
          <li class="nav-item"><a class="nav-link" href="produto.php">Produto</a></li>
          <li class="nav-item"><a class="nav-link" href="relatorioEstoque.php">Estoque</a></li>
          <li class="nav-item"><a class="nav-link" href="servico.php">Serviço</a></li>
          <li class="nav-item"><a class="nav-link" href="item_servico.php">Item Serviço</a></li>
          <li class="nav-item"><a class="nav-link" href="servico_funcionario.php">Serviço Funcionário</a></li>
          <li class="nav-item"><a class="nav-link" href="tipo_pagamento.php">Tipo Pagamento</a></li>
        </ul>

        <div class="d-flex align-items-center gap-3">
          <span class="navbar-text text-white">Olá, <?= htmlspecialchars($_SESSION["usuario_nome"]) ?></span>
          <form action="logout.php" method="post" class="d-inline">
            <button type="submit" class="btn btn-outline-light btn-sm">Sair</button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
