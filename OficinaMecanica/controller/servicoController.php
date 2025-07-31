<?php
require_once "model/servico.php";
require_once 'model/tipo_pagamento.php';
require_once 'model/agendamento.php';
require_once 'model/Item_servico.php';

class servicoController {
    private $model;
    private $tipoPagamentoModel;
    private $agendamentoModel;
    private $item_servicoModel;

    public function __construct(){
        $this->model = new Servico();
        $this->tipoPagamentoModel = new Tipo_pagamento();
        $this->agendamentoModel = new Agendamento();
        $this->item_servicoModel = new Item_servico();
    }

    public function listar(){
        $servicos = $this->model->listaComClienteEVeiculo();
        include "view/listarservico.php";
    }

    public function listarTiposPagamento(){
        return $this->tipoPagamentoModel->listaTodos();
    }

    public function listarCb(){
        return $this->model->listaTodos();
    }

    public function formNovo(){
        $tipos_pagamento = $this->listarTiposPagamento();
        $agendamentos = $this->agendamentoModel->listaTodos();
        include "view/formServico.php";
    }

    public function buscaId($id){
        $servico = $this->model->listaId($id);
        $tipos_pagamento = $this->listarTiposPagamento();
        $agendamentos = $this->agendamentoModel->listaTodos();

        $itens = $this->item_servicoModel->listarPorServico($id);
        if(count($itens) > 0){
            $servico['valor_total'] = $this->model->calcularValorTotal($id);
        } else {
            $servico['valor_total'] = null;
        }

        include "view/formServico.php";
    }

    public function cadastrar($tipo_servico, $descricao, $idagendamento, $status_servico, $idtipo_pagamento, $mao_obra){
        $agendamento = $this->agendamentoModel->listaId($idagendamento);
        if (!$agendamento) {
            header("location:servico.php?erro=agendamento_invalido");
            exit;
        }

        $idcliente = $agendamento['idcliente'];
        $idveiculo = $agendamento['idveiculo'];

        if ($idtipo_pagamento === "null" || $idtipo_pagamento === "") {
            $idtipo_pagamento = null;
        }
        if ($mao_obra === "null" || $mao_obra === "" || !is_numeric($mao_obra)) {
            $mao_obra = 0;
        }

        // Cadastra serviço com valor_total inicialmente NULL
        $this->model->cadastrar(
            $tipo_servico,
            $descricao,
            $idcliente,
            $idveiculo,
            $status_servico,
            $idtipo_pagamento,
            $mao_obra,
            null,
            $idagendamento
        );

        header("location:servico.php");
        exit;
    }

    public function alterar($id, $tipo_servico, $descricao, $idagendamento, $status_servico, $idtipo_pagamento, $mao_obra){
        $agendamento = $this->agendamentoModel->listaId($idagendamento);
        if (!$agendamento) {
            header("location:servico.php?erro=agendamento_invalido");
            exit;
        }

        $idcliente = $agendamento['idcliente'];
        $idveiculo = $agendamento['idveiculo'];

        if ($idtipo_pagamento === "null" || $idtipo_pagamento === "") {
            $idtipo_pagamento = null;
        }
        if ($mao_obra === "null" || $mao_obra === "" || !is_numeric($mao_obra)) {
            $mao_obra = 0;
        }

        // Atualiza serviço (valor_total é ajustado depois)
        $this->model->alterar(
            $tipo_servico,
            $descricao,
            $idcliente,
            $idveiculo,
            $status_servico,
            $idtipo_pagamento,
            $mao_obra,
            null, // valor_total será atualizado com base nos itens
            $id,
            $idagendamento
        );

        // Atualiza automaticamente o valor_total com base nos itens e mão de obra
        $this->model->atualizarTotalAutomatico($id);

        header("location:servico.php");
        exit;
    }

    public function excluir($id){
        $this->model->excluir($id);
        header("location:servico.php");
        exit;
    }
}
?>








