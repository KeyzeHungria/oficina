<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Clientes</title>
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
require_once "controller/produtoController.php";
require_once "view/formEstoque.php";

$controller = new produtoController();

/* Converte e valida: inteiro ≥ 1 (padrão 5) */
$limite = filter_input(
    INPUT_GET,
    'quantidade',
    FILTER_VALIDATE_INT,
    ['options' => ['default' => 5, 'min_range' => 1]]
);

/* Obtenha a lista e a passe para a view interna */
$produtos = $controller->baixoEstoque($limite);

/* Exemplo de uso extra fora da view (opcional) */
echo "<p class='text-muted small ms-3'>Total: <strong>" . count($produtos) .
     "</strong> produto(s) com ≤ {$limite} no estoque.</p>";
?>

</div>

<footer class="bg-dark text-white text-center py-3 fixed-bottom">
  Sistema Oficina Mão na Graxa &copy; <?= date('Y') ?> — Desenvolvido por Gabriella Louzada, Naira Venâncio e Keyze Rodrigues
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
