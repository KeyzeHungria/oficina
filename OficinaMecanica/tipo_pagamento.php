<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Tipo de Pagamento</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

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
require_once "controller/tipo_pagamentoController.php";

$controller = new tipo_pagamentoController();

if(!isset($_GET["acao"])) {
    // Verificar o POST
    if(isset($_POST["acao"])) {
        if($_POST["acao"] == "cadastrar") {
            $controller->cadastrar(
                $_POST["nr_parcelas"],
                $_POST["prazo_primeira"],
                $_POST["intervalo"],
                $_POST["nome"],
                $_POST["juros"]
            );
        } else {
            $controller->alterar(
                $_POST["id"], 
                $_POST["nr_parcelas"],
                $_POST["prazo_primeira"],
                $_POST["intervalo"],
                $_POST["nome"],
                $_POST["juros"]
            );
        }
    }
    // Listar
    $controller->listar();

} else {
    $acao = $_GET["acao"];
    switch($acao) {
        case 'novo':
            // Cadastrar
            include 'view/formtipo_pagamento.php';
            break;
        case 'excluir':
            // Excluir
            $controller->excluir($_GET["id"]);
            break;
        case 'editar':
            // Editar
            $controller->buscaId($_GET["id"]);
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
