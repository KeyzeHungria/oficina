<?php
require_once "model/produto.php";

class produtoController {
    private $model;

    public function __construct(){
        $this->model = new produto();
    }

    public function listar(){
        $produtos = $this->model->listaTodos();
        include "view/listarProduto.php";
    }

    public function baixoEstoque(int $quantidade = 5): array {
        $produtos = $this->model->baixoEstoque($quantidade);
        $total    = count($produtos);
        include "view/listarEstoque.php";
        return $produtos;
    }

    public function listarCb(){
        return $this->model->listaTodos();
    }

    public function cadastrar($nome, $quantidade, $data_entrada, $data_saida, $modelo, $marca, $ano, $preco, $lote, $data_vencimento){
        $this->model->cadastrar($nome, $quantidade, $data_entrada, $data_saida, $modelo, $marca, $ano, $preco, $lote, $data_vencimento);
        header("location:produto.php");
    }

    public function buscaId($id){
        $produto = $this->model->listaId($id);
        include "view/formProduto.php";
    }

    public function alterar($id, $nome, $quantidade, $data_entrada, $data_saida, $modelo, $marca, $ano, $preco, $lote, $data_vencimento){
        $this->model->alterar($nome, $quantidade, $data_entrada, $data_saida, $modelo, $marca, $ano, $preco, $lote, $data_vencimento, $id);
        header("location:produto.php");
    }

    public function excluir($id){
        if ($this->model->excluir($id)) {
            header("Location: produto.php?mensagem=✅ Produto excluído com sucesso!&tipo=success");
        } else {
            header("Location: produto.php?mensagem=❌ Erro ao excluir produto!&tipo=danger");
        }
        exit;
    }
}
?>
