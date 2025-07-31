<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Usuários</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
require_once "controller/usuarioController.php";
$controller = new usuarioController();

// 🔔 Função para exibir mensagens (tipo: success, danger, warning, info)
function mostrarMensagem() {
    if (isset($_GET['mensagem']) && isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];
        $mensagem = htmlspecialchars($_GET['mensagem']);
        echo "<div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
                $mensagem
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
              </div>";
    }

    // Exceção para login duplicado
    if (!empty($_GET['erro']) && $_GET['erro'] === 'login_duplicado') {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erro: Este login já está cadastrado no sistema.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
              </div>";
    }
}

mostrarMensagem();

// 🌐 Roteamento de ações
if (!isset($_GET["acao"])) {

    // Se formulário enviado via POST
    if (isset($_POST["acao"])) {
        if ($_POST["acao"] === "cadastrar") {
            $controller->cadastrar(
                $_POST["senha"],
                $_POST["nome"],
                $_POST["email"],
                $_POST["login"]
            );
        } else {
            $controller->alterar(
                $_POST["id"],
                $_POST["senha"],
                $_POST["nome"],
                $_POST["email"],
                $_POST["login"]
            );
        }
    }

    $controller->listar();

} else {
    $acao = $_GET["acao"];
    switch ($acao) {
        case 'novo':
            include 'view/formUsuario.php';
            break;
        case 'editar':
            $controller->buscaId($_GET["id"]);
            break;
        case 'excluir':
            $controller->excluir($_GET["id"]);
            break;
        default:
            $controller->listar();
            break;
    }
}
?>

</div>

<footer class="bg-dark text-white text-center py-3 fixed-bottom">
  Sistema Oficina Mão na Graxa &copy; <?= date('Y') ?> — Desenvolvido por Gabriella Louzada
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

