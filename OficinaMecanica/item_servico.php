<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Itens de Serviço</title>
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
// Inclui os controllers necessários
include "controller/item_servicoController.php";
include "controller/produtoController.php";
include "controller/servicoController.php";

$controller = new item_servicoController();
$produtoController = new produtoController();
$servicoController = new servicoController();

// Função para mostrar mensagens usando Bootstrap alert
function mostrarMensagem() {
    if (isset($_GET['mensagem']) && isset($_GET['tipo'])) {
        $tipo = $_GET['tipo']; // success, danger, info, warning
        $mensagem = htmlspecialchars($_GET['mensagem']);
        echo "<div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
                $mensagem
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>
              </div>";
    }
}

mostrarMensagem();

if (!isset($_GET["acao"])) {
    // Se o formulário foi enviado
    if (isset($_POST["acao"])) {
        $data = $_POST;

        if ($_POST["acao"] == "cadastrar") {
            $resultado = $controller->salvar();  // Pode criar salvar() no controller que chama cadastrar ou alterar conforme editando
            if ($resultado !== true) {
                header("Location: item_servico.php?acao=novo&erro=$resultado");
                exit;
            }
            header("Location: item_servico.php?mensagem=Item de serviço cadastrado com sucesso.&tipo=success");
            exit;
        } elseif ($_POST["acao"] == "alterar") {
            $resultado = $controller->salvar();
            if ($resultado !== true) {
                $idproduto = urlencode($data['idproduto']);
                $idservico = urlencode($data['idservico']);
                header("Location: item_servico.php?acao=editar&idproduto=$idproduto&idservico=$idservico&erro=$resultado");
                exit;
            }
            header("Location: item_servico.php?mensagem=Item de serviço alterado com sucesso.&tipo=success");
            exit;
        }
    }
    // Nenhuma ação - listar tudo
    $controller->listar();

} else {
    $acao = $_GET["acao"];
    switch ($acao) {
        case 'novo':
            $produtos = $produtoController->listarCb();
            $servicos = $servicoController->listarCb();
            include 'view/formItem_servico.php';
            break;

        case 'editar':
            $produtos = $produtoController->listarCb();
            $servicos = $servicoController->listarCb();
            $controller->editar(); // Já carrega e inclui form
            break;

        case 'excluir':
            $controller->excluir();
            header("Location: item_servico.php?mensagem=Item de serviço excluído com sucesso.&tipo=success");
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


</div>

<footer class="bg-dark text-white text-center py-3 fixed-bottom">
  Sistema Oficina Mão na Graxa &copy; <?= date('Y') ?> — Desenvolvido por Gabriella Louzada, Naira Venâncio e Keyze Rodrigues
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
