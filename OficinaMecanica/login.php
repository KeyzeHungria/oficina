<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php

include "menulogin.php";

session_start(); // Inicia a sessão para controlar o login

require_once "controller/usuarioController.php";

$controller = new usuarioController();

if (isset($_POST["login"]) && isset($_POST["senha"])) {
    $usuario = $controller->login($_POST["login"], $_POST["senha"]);

    if ($usuario === false) {
        $erro = "Usuário e/ou senha incorretos.";
        include "view/formLogin.php"; // Mostra o formulário com erro
    } else {
        // Login OK: salva dados na sessão e redireciona para página protegida
        $_SESSION["usuario_id"] = $usuario["idusuario"];
        $_SESSION["usuario_nome"] = $usuario["nome"];
        $_SESSION["usuario_login"] = $usuario["login"];

        header("Location:index.php"); // Redirecione para onde quiser após login
        exit();
    }
} else {
    // Nenhum POST enviado ainda, apenas exibe o formulário
    include "view/formLogin.php";
}
?>

<footer class="bg-dark text-white text-center py-3 fixed-bottom">
  Sistema Oficina Mão na Graxa &copy; <?= date('Y') ?> — Desenvolvido por Gabriella Louzada, Naira Venâncio e Keyze Rodrigues
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
