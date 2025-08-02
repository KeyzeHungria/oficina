<?php 
session_start();
require_once "controller/usuarioController.php";
$controller = new usuarioController();

$usuarioTipoLogado = $_SESSION["usuario_tipo"] ?? 'usuario'; // tipo do usuário logado

// Função para exibir mensagens (tipo: success, danger, warning, info)
function mostrarMensagem() {
    if (isset($_GET['mensagem']) && isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];
        $mensagem = htmlspecialchars($_GET['mensagem']);
        echo "<div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
                $mensagem
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
              </div>";
    }

    if (!empty($_GET['erro'])) {
        if ($_GET['erro'] === 'login_duplicado') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Erro: Este login já está cadastrado no sistema.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
                  </div>";
        } elseif ($_GET['erro'] === 'permissao_negada') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Erro: Você não tem permissão para executar esta ação.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
                  </div>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Usuários</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

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
mostrarMensagem();

if (!isset($_GET["acao"])) {
    // Se formulário enviado via POST
    if (isset($_POST["acao"])) {
        if ($_POST["acao"] === "cadastrar") {
            $controller->cadastrar(
                $_POST["senha"],
                $_POST["nome"],
                $_POST["email"],
                $_POST["login"],
                $_POST["tipo"] ?? 'usuario'
            );
            exit; // Para o script após cadastro
        } else {
            $controller->alterar(
                $_POST["id"],
                $_POST["senha"],
                $_POST["nome"],
                $_POST["email"],
                $_POST["login"],
                $_POST["tipo"] ?? 'usuario'
            );
            exit; // Para o script após alteração
        }
    }

    if ($usuarioTipoLogado === 'admin') {
        $usuarios = $controller->listarCb();
    } else {
        $usuarios = [$controller->buscaIdParaLista($_SESSION['usuario_id'])];
    }
    ?>

    <div class="card shadow-sm">
      <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Usuários</h3>
        <?php if ($usuarioTipoLogado === 'admin'): ?>
          <a href="?acao=novo" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle me-2"></i>Novo Usuário
          </a>
        <?php endif; ?>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Login</th>
              <th>Email</th>
              <th>Tipo</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario): ?>
              <tr>
                <td><?= htmlspecialchars($usuario['idusuario']) ?></td>
                <td><?= htmlspecialchars($usuario['nome']) ?></td>
                <td><?= htmlspecialchars($usuario['login']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= htmlspecialchars($usuario['tipo']) ?></td>
                <td>
                  <a href="?acao=editar&id=<?= $usuario['idusuario'] ?>" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square"></i> Editar
                  </a>
                  <?php if ($usuarioTipoLogado === 'admin'): ?>
                    <a href="?acao=excluir&id=<?= $usuario['idusuario'] ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                      <i class="bi bi-trash"></i> Excluir
                    </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

<?php
} else {
    $acao = $_GET["acao"];
    switch ($acao) {
        case 'novo':
            if ($usuarioTipoLogado !== 'admin') {
                header("location:usuario.php?erro=permissao_negada");
                exit;
            }
            include 'view/formUsuario.php';
            break;
        case 'editar':
            $controller->buscaId($_GET["id"]);
            break;
        case 'excluir':
            if ($usuarioTipoLogado !== 'admin') {
                header("location:usuario.php?erro=permissao_negada");
                exit;
            }
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



