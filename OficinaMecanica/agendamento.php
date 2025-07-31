<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agendamentos</title>
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
// Inclui os controllers
include "controller/agendamentoController.php";
include "controller/veiculoController.php";
include "controller/clienteController.php";

$controller = new agendamentoController();
$clientecontroller = new clienteController();
$veiculocontroller = new veiculoController();

// Função para mostrar mensagens com Bootstrap alert
function mostrarMensagem() {
    if (isset($_GET['mensagem']) && isset($_GET['tipo'])) {
        $tipo = $_GET['tipo']; // ex: success, danger, info, warning
        $mensagem = htmlspecialchars($_GET['mensagem']);
        echo "<div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
                $mensagem
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
              </div>";
    }
}

mostrarMensagem();

if (!isset($_GET["acao"])) {
    if (isset($_POST["acao"])) {
        $data = $_POST["data"];
        $horario = $_POST["horario"];
        $status_agendamento = $_POST["status_agendamento"] ?? null;
        $idcliente = $_POST["idcliente"];
        $idveiculo = $_POST["idveiculo"];

        if ($_POST["acao"] == "cadastrar") {
            $resultado = $controller->cadastrar($data, $horario, $idcliente, $idveiculo);
            if ($resultado !== true) {
                header("Location: agendamento.php?acao=novo&erro=$resultado");
                exit;
            }
            header("Location: agendamento.php?mensagem=Agendamento cadastrado com sucesso.&tipo=success");
            exit;
        } else {
            $id = $_POST["id"];
            $resultado = $controller->alterar($id, $data, $horario, $status_agendamento, $idcliente, $idveiculo);
            if ($resultado !== true) {
                header("Location: agendamento.php?acao=editar&id=$id&erro=$resultado");
                exit;
            }
            header("Location: agendamento.php?mensagem=Agendamento alterado com sucesso.&tipo=success");
            exit;
        }
    }
    $controller->listar();
} else {
    $acao = $_GET["acao"];
    switch ($acao) {
        case 'novo':
            $clientes = $clientecontroller->listarCb();
            $veiculos = $veiculocontroller->listarCb();
            include 'view/formAgendamento.php';
            break;
        case 'editar':
            $clientes = $clientecontroller->listarCb();
            $veiculos = $veiculocontroller->listarCb();
            $controller->buscaId($_GET["id"], $clientes, $veiculos);
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
