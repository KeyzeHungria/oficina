<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Funcionários</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
  require_once "controller/funcionarioController.php";

  $controller = new funcionarioController();

  // ✅ Exibir mensagens (sucesso, erro, aviso) com segurança
  if (isset($_GET['mensagem']) && isset($_GET['tipo'])) {
      $mensagem = htmlspecialchars($_GET['mensagem']);
      $tipo = htmlspecialchars($_GET['tipo']); // success | danger | warning | info
      echo "<div class='alert alert-{$tipo} alert-dismissible fade show' role='alert'>
              {$mensagem}
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
            </div>";
  }

  if (!isset($_GET["acao"])) {
      if (isset($_POST["acao"])) {
          if ($_POST["acao"] == "cadastrar") {
              $controller->cadastrar(
                  $_POST["nome"],
                  $_POST["tipo_funcionario"],
                  $_POST["telefone"],
                  $_POST["email"],
                  $_POST["logradouro"],
                  $_POST["numero"],
                  $_POST["bairro"],
                  $_POST["complemento"],
                  $_POST["cep"],
                  $_POST["cpf"],
                  $_POST["data_de_nascimento"],
                  $_POST["cidade"],
                  $_POST["estado"]
              );
          } else {
              $controller->alterar(
                  $_POST["id"],
                  $_POST["nome"],
                  $_POST["tipo_funcionario"],
                  $_POST["telefone"],
                  $_POST["email"],
                  $_POST["logradouro"],
                  $_POST["numero"],
                  $_POST["bairro"],
                  $_POST["complemento"],
                  $_POST["cep"],
                  $_POST["cpf"],
                  $_POST["data_de_nascimento"],
                  $_POST["cidade"],
                  $_POST["estado"]
              );
          }
          exit; // Redirecionamento já é feito no controller
      }

      $controller->listar();

  } else {
      $acao = $_GET["acao"];
      switch ($acao) {
          case 'novo':
              include 'view/formFuncionario.php';
              break;
          case 'editar':
              $controller->buscaId($_GET["id"]);
              break;
          case 'excluir':
              $controller->excluir($_GET["id"]);
              exit;
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


