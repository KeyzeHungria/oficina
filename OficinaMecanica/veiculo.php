<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Veículos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
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

include "controller/veiculoController.php";
include "controller/clienteController.php";

$controller = new veiculoController();
$clientecontroller = new clienteController();

// Função para exibir mensagens de alerta com Bootstrap e ícones
function mostrarMensagem() {
    if (isset($_GET['mensagem']) && isset($_GET['tipo'])) {
        $tipos_validos = ['success', 'danger', 'warning', 'info', 'primary', 'secondary', 'light', 'dark'];
        $tipo = in_array($_GET['tipo'], $tipos_validos) ? $_GET['tipo'] : 'info';
        $mensagem = htmlspecialchars($_GET['mensagem']);

        $icones = [
            'success' => 'bi-check-circle-fill',
            'danger' => 'bi-x-circle-fill',
            'warning' => 'bi-exclamation-triangle-fill',
            'info' => 'bi-info-circle-fill',
            'primary' => 'bi-info-circle-fill',
            'secondary' => 'bi-info-circle-fill',
            'light' => 'bi-info-circle-fill',
            'dark' => 'bi-info-circle-fill'
        ];
        $icone = $icones[$tipo];

        echo "<div class='alert alert-$tipo alert-dismissible fade show d-flex align-items-center' role='alert'>
                <i class='bi $icone me-2 fs-4'></i> 
                <div>$mensagem</div>
                <button type='button' class='btn-close ms-auto' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}

mostrarMensagem();

if (!isset($_GET["acao"])) {
    if (isset($_POST["acao"])) {
        if ($_POST["acao"] == "cadastrar") {
            $controller->cadastrar(
                $_POST["modelo"],
                $_POST["ano"],
                $_POST["placa"],
                $_POST["chassi"],
                $_POST["marca"],
                $_POST["idcliente"]
            );
        } else {
            $controller->alterar(
                $_POST["id"],
                $_POST["modelo"],
                $_POST["ano"],
                $_POST["placa"],
                $_POST["chassi"],
                $_POST["marca"],
                $_POST["idcliente"]
            );
        }
    }

    // Listar veículos
    $controller->listar();

} else {
    $acao = $_GET["acao"];
    switch ($acao) {
        case 'novo':
            $clientes = $clientecontroller->listarCb();
            include 'view/formVeiculo.php';
            break;
        case 'editar':
            $clientes = $clientecontroller->listarCb();
            $controller->buscaId($_GET["id"], $clientes);
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
  Sistema Oficina Mão na Graxa &copy; <?= date('Y') ?> — Desenvolvido por Gabriella Louzada, Naira Venâncio e Keyze Rodrigues
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
