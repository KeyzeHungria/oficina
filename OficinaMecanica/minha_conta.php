<?php
session_start();
require_once "controller/minhacontaController.php";
$controller = new minhacontaController();

$acao = $_GET["acao"] ?? "editar";

if ($acao === "atualizar") {
    $controller->atualizar($_POST["nome"], $_POST["email"], $_POST["login"], $_POST["senha"]);
} elseif ($acao === "excluir") {
    $controller->excluirConta();
} else {
    $controller->editar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Minha Conta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Rodapé fixo manual -->
<footer class="bg-dark text-white text-center py-3 fixed-bottom">
  Sistema Oficina Mão na Graxa &copy; <?= date('Y') ?> — Desenvolvido por Gabriella Louzada
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

