<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Serviços</title>
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
require_once "controller/servicoController.php";
require_once "controller/agendamentoController.php";

$controller = new servicoController();
$agendamentoController = new agendamentoController();

// Define ação (GET ou POST)
$acao = $_REQUEST['acao'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe dados do form com tratamento básico
    $tipo_servico = $_POST["tipo_servico"] ?? '';
    $descricao = $_POST["descricao"] ?? '';
    $idagendamento = $_POST["idagendamento"] ?? null;
    $status_servico = $_POST["status_servico"] ?? '';
    $idtipo_pagamento = $_POST["idtipo_pagamento"] ?? null;
    $mao_obra = $_POST["mao_obra"] ?? 0;

    // Corrige vírgulas para ponto em valores numéricos
    $mao_obra = str_replace(',', '.', $mao_obra);

    // Tratar valores
    if ($idtipo_pagamento === "" || $idtipo_pagamento === "null") {
        $idtipo_pagamento = null;
    }
    if (!is_numeric($mao_obra)) {
        $mao_obra = 0;
    }

    if ($acao === "cadastrar") {
        $controller->cadastrar(
            $tipo_servico,
            $descricao,
            $idagendamento,
            $status_servico,
            $idtipo_pagamento,
            $mao_obra
        );
    } elseif ($acao === "atualizar") {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $controller->alterar(
                $id,
                $tipo_servico,
                $descricao,
                $idagendamento,
                $status_servico,
                $idtipo_pagamento,
                $mao_obra
            );
        }
    }
} else {
    // GET requests e outros tratamentos
    switch ($acao) {
        case 'novo':
            $agendamentos = $agendamentoController->listarCb();
            $tipos_pagamento = $controller->listarTiposPagamento();
            include 'view/formServico.php';
            break;

        case 'editar':
            $id = $_GET['id'] ?? null;
            if ($id) {
                $agendamentos = $agendamentoController->listarCb();
                $tipos_pagamento = $controller->listarTiposPagamento();
                $controller->buscaId($id);
            } else {
                $controller->listar();
            }
            break;

        case 'excluir':
            $id = $_GET['id'] ?? null;
            if ($id) {
                $controller->excluir($id);
            }
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

