<?php
require_once "model/item_servico.php";
require_once "model/produto.php";
require_once "model/servico.php";

class item_servicoController {
    private $model;
    private $servicoModel;

    public function __construct(){
        $this->model = new item_servico();
        $this->servicoModel = new Servico();
    }

    public function listar(){
        $itens = $this->model->listaTodos();
        include "view/listarItem_servico.php";
    }

    public function novo(){
        $produtos = (new produto())->listaTodos();
        $servicos = (new servico())->listaTodos();
        $item = false;  // indica que não é edição
        include "view/formItem_servico.php";
    }

    public function salvar(){
        $data = $_POST;
        $subtotal = $data['qtd_pecas_utilizadas'] * $data['preco_unitario'];
        $idservico = $data['idservico'];

        if (isset($data['acao']) && $data['acao'] == 'alterar') {
            // Editar
            $resultado = $this->model->alterar(
                $data['idproduto'],
                $idservico,
                $data['codigo_item'],
                $data['qtd_pecas_utilizadas'],
                $data['preco_unitario'],
                $subtotal
            );

            if ($resultado) {
                $this->servicoModel->atualizarTotalAutomatico($idservico);
                return true;
            } else {
                return "Erro ao alterar item de serviço.";
            }

        } else {
            // Cadastrar - verifica duplicidade antes
            if ($this->model->existe($data['idproduto'], $idservico)) {
                return 'duplicado'; // erro de duplicidade
            }

            $resultado = $this->model->cadastrar(
                $data['idproduto'],
                $idservico,
                $data['codigo_item'],
                $data['qtd_pecas_utilizadas'],
                $data['preco_unitario'],
                $subtotal
            );

            if ($resultado) {
                $this->servicoModel->atualizarTotalAutomatico($idservico);
                return true;
            } else {
                return "Erro ao cadastrar item de serviço.";
            }
        }
    }

    public function editar(){
        $idproduto = intval($_GET['idproduto']);
        $idservico = intval($_GET['idservico']);
        $item = $this->model->listaId($idproduto, $idservico);

        $produtos = (new produto())->listaTodos();
        $servicos = (new servico())->listaTodos();

        include "view/formItem_servico.php";
    }

    public function excluir(){
        $idproduto = intval($_GET['idproduto']);
        $idservico = intval($_GET['idservico']);

        $this->model->excluir($idproduto, $idservico);

        // Atualiza o valor total do serviço após excluir item
        $this->servicoModel->atualizarTotalAutomatico($idservico);

        header("Location: item_servico.php?mensagem=Item de serviço excluído com sucesso.&tipo=success");
        exit;
    }
}
?>


