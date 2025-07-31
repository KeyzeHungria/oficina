<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Produtos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      overflow-x: hidden;
    }

    .navbar .navbar-nav {
      flex-wrap: wrap;
    }

    .navbar form {
      white-space: nowrap;
    }
  </style>
</head>
<body class="bg-light">

<?php include "menu.php"; ?>

<div class="container mt-4">
<?php
  require_once "controller/produtoController.php";

  $controller = new produtoController();

  // Exibir mensagens (sucesso ou erro)
  if (isset($_GET['mensagem'])) {
      $tipo = $_GET['tipo'] ?? 'success'; // success | danger | warning
      echo "<div class='alert alert-{$tipo} alert-dismissible fade show' role='alert'>
              {$_GET['mensagem']}
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
            </div>";
  }

  if (!isset($_GET["acao"])) {
      if (isset($_POST["acao"])) {
          if ($_POST["acao"] == "cadastrar") {
              $controller->cadastrar(
                  $_POST["nome"],
                  $_POST["quantidade"],
                  $_POST["data_entrada"],
                  $_POST["data_saida"],
                  $_POST["modelo"],
                  $_POST["marca"],
                  $_POST["ano"],
                  $_POST["preco"],
                  $_POST["lote"],
                  $_POST["data_vencimento"]
              );
          } else {
              $controller->alterar(
                  $_POST["id"],
                  $_POST["nome"],
                  $_POST["quantidade"],
                  $_POST["data_entrada"],
                  $_POST["data_saida"],
                  $_POST["modelo"],
                  $_POST["marca"],
                  $_POST["ano"],
                  $_POST["preco"],
                  $_POST["lote"],
                  $_POST["data_vencimento"]
              );
          }
          exit; // Sai aqui, pois o controller já redireciona
      }

      $controller->listar();

  } else {
      $acao = $_GET["acao"];
      switch ($acao) {
          case 'novo':
              include 'view/formProduto.php';
              break;
          case 'editar':
              $controller->buscaId($_GET["id"]);
              break;
          case 'excluir':
              $controller->excluir($_GET["id"]);
              exit; // Sai para evitar executar código abaixo após exclusão
              break;
      }
  }
?>
</div>

<footer class="bg-dark text-white text-center py-3 fixed-bottom">
  Sistema Oficina Mão na Graxa &copy; <?= date('Y') ?> — Desenvolvido por Gabriella Louzada, Naira Venâncio e Keyze Rodrigues
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
