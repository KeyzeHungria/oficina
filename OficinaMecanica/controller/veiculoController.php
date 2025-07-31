<?php
require_once "model/veiculo.php";
require_once "model/cliente.php"; // necessário para carregar os clientes

class veiculoController {
    private $model;
    private $clienteModel;

    public function __construct(){
        $this->model = new Veiculo();
        $this->clienteModel = new Cliente(); // instanciando o model de cliente
    }

    public function listar(){
        $veiculos = $this->model->listaTodos();
        include "view/listarVeiculo.php";
    }

    public function listarCb(){
        $veiculos = $this->model->listaTodos();
        return $veiculos;
    }

    public function cadastrar($modelo, $ano, $placa, $chassi, $marca, $idcliente){
        if ($this->model->placaExiste($placa)) {
            header("Location: veiculo.php?mensagem=❌ Placa já cadastrada!&tipo=danger");
            exit;
        }

        if ($this->model->chassiExiste($chassi)) {
            header("Location: veiculo.php?mensagem=❌ Chassi já cadastrado!&tipo=danger");
            exit;
        }

        $this->model->cadastrar($modelo, $ano, $placa, $chassi, $marca, $idcliente);
        header("Location: veiculo.php?mensagem=✅ Veículo cadastrado com sucesso!&tipo=success");
        exit;
    }

    public function buscaId($id){
        $veiculo = $this->model->listaId($id);
        $clientes = $this->clienteModel->listaTodos(); // necessário para o <select> funcionar corretamente
        include "view/formVeiculo.php";
    }

    public function alterar($id, $modelo, $ano, $placa, $chassi, $marca, $idcliente){
        if ($this->model->placaExisteEmOutroVeiculo($placa, $id)) {
            header("Location: veiculo.php?mensagem=❌ Essa placa já pertence a outro veículo!&tipo=danger");
            exit;
        }

        if ($this->model->chassiExisteEmOutroVeiculo($chassi, $id)) {
            header("Location: veiculo.php?mensagem=❌ Esse chassi já pertence a outro veículo!&tipo=danger");
            exit;
        }

        $this->model->alterar($modelo, $ano, $placa, $chassi, $marca, $idcliente, $id);
        header("Location: veiculo.php?mensagem=✅ Veículo atualizado com sucesso!&tipo=success");
        exit;
    }

    public function excluir($id){
        if ($this->model->excluir($id)) {
            header("Location: veiculo.php?mensagem=✅ Veículo excluído com sucesso!&tipo=success");
        } else {
            header("Location: veiculo.php?mensagem=❌ Erro ao excluir veículo!&tipo=danger");
        }
        exit;
    }
}
?>

