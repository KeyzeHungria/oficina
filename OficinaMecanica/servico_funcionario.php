<?php


// Includes dos controllers
include "controller/servico_funcionarioController.php";
include "controller/servicoController.php";
include "controller/funcionarioController.php";

$controller = new servico_funcionarioController();
$servicoController = new servicoController();
$funcionarioController = new funcionarioController();

// Função para mostrar mensagens via Bootstrap alert
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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Associação Serviço & Funcionário</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<?php include "menu.php"; ?>

<div class="container mt-4">

<?php
mostrarMensagem();

if (!isset($_GET['acao'])) {
    // Processa cadastro se veio do form
    if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar') {
        $success = $controller->cadastrar($_POST['idservico'], $_POST['idfuncionario']);
        if ($success) {
            header("Location: servico_funcionario.php?mensagem=Associação cadastrada com sucesso!&tipo=success");
            exit;
        } else {
            header("Location: servico_funcionario.php?mensagem=Erro ao cadastrar associação.&tipo=danger");
            exit;
        }
    }
    // Caso padrão, lista todas as associações
    $controller->listar();

} else {
    $acao = $_GET['acao'];
    switch ($acao) {
        case 'novo':
            $servicos = $servicoController->listarCb();
            $funcionarios = $funcionarioController->listarCb();
            include 'view/formServico_funcionario.php';
            break;

        case 'excluir':
            if (isset($_GET['idservico']) && isset($_GET['idfuncionario'])) {
                $success = $controller->excluir($_GET['idservico'], $_GET['idfuncionario']);
                if ($success) {
                    header("Location: servico_funcionario.php?mensagem=Associação excluída com sucesso!&tipo=success");
                } else {
                    header("Location: servico_funcionario.php?mensagem=Erro ao excluir associação.&tipo=danger");
                }
            }
            exit;

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
