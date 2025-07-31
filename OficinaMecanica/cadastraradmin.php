<?php
require_once "model/usuario.php";

$usuario = new Usuario();
$adminExiste = $usuario->buscaPorLogin("admin");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container">
  <?php if (!$adminExiste): ?>
    <?php
      $usuario->cadastrar("admin123", "admin", "", "admin");
    ?>
    <div class="alert alert-success" role="alert">
      ✅ Usuário <strong>admin</strong> cadastrado com sucesso!
    </div>
  <?php else: ?>
    <div class="alert alert-warning" role="alert">
      ⚠️ O usuário <strong>admin</strong> já está cadastrado.
    </div>
  <?php endif; ?>

  <a href="login.php" class="btn btn-primary mt-3">
    <i class="bi bi-arrow-left"></i> Voltar para o Login
  </a>
</div>

<!-- Bootstrap Icons (para o ícone da seta) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
