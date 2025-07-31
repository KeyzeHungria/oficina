<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Oficina - Página Inicial</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS e ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  <!-- Menu -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand text-warning" href="#">Oficina Mecânica</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuOficina" aria-controls="menuOficina" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <!-- Conteúdo principal -->
  <div class="container text-center mt-5">
    <h1 class="mb-4">Bem-vindo a oficina Mão na Graxa</h1>
    <p class="lead">Escolha uma das opções abaixo:</p>

    <div class="row mt-4 g-3 justify-content-center">

      <div class="col-md-2">
        <a href="usuario.php" class="btn btn-dark w-100">
          <i class="bi bi-box-seam-fill"></i> Usuario
        </a>
      </div>

      <div class="col-md-2">
        <a href="cliente.php" class="btn btn-dark w-100">
          <i class="bi bi-person-fill"></i> Cliente
        </a>
      </div>

      <div class="col-md-2">
        <a href="funcionario.php" class="btn btn-dark w-100">
          <i class="bi bi-person-badge-fill"></i> Funcionário
        </a>
      </div>

      <div class="col-md-2">
        <a href="agendamento.php" class="btn btn-dark w-100">
          <i class="bi bi-calendar-check-fill"></i> Agendamento
        </a>
      </div>

      <div class="col-md-2">
        <a href="veiculo.php" class="btn btn-dark w-100">
          <i class="bi bi-truck-front-fill"></i> Veículo
        </a>
      </div>

      <div class="col-md-2">
        <a href="pagamento.php" class="btn btn-dark w-100">
          <i class="bi bi-credit-card-fill"></i> Pagamento
        </a>
      </div>

      <div class="col-md-2">
        <a href="produto.php" class="btn btn-dark w-100">
          <i class="bi bi-box-seam-fill"></i> Produto
        </a>
      </div>

      <div class="col-md-2">
        <a href="relatorioEstoque.php" class="btn btn-dark w-100">
          <i class="bi bi-box-seam-fill"></i> Estoque
        </a>
      </div>

      <div class="col-md-2">
        <a href="servico.php" class="btn btn-dark w-100">
          <i class="bi bi-box-seam-fill"></i> Serviço
        </a>
      </div>

      <div class="col-md-2">
        <a href="item_servico.php" class="btn btn-dark w-100">
          <i class="bi bi-box-seam-fill"></i> Item Serviço
        </a>
      </div>

      <div class="col-md-2">
        <a href="servico_funcionario.php" class="btn btn-dark w-100">
          <i class="bi bi-box-seam-fill"></i> Serviço Funcionario
        </a>
      </div>

        <div class="col-md-2">
        <a href="tipo_pagamento.php" class="btn btn-dark w-100">
          <i class="bi bi-box-seam-fill"></i> Tipo de Pagamento 
        </a>
      </div>


      <div class="col-md-2">
        <a href="login.php" class="btn btn-dark w-100">
          <i class="bi bi-box-seam-fill"></i> Login
        </a>
      </div>




    </div>
  </div>
  <div class="text-center my-4">
  <img src="img/logo.png" alt="Logo Mão na Graxa" class="img-fluid" style="max-height: 400px;">
</div>

  <!-- Bootstrap JS (opcional para menu responsivo) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>