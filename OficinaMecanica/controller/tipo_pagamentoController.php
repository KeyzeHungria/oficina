<?php
require_once "model/tipo_pagamento.php";

class tipo_pagamentoController {
    private $model;

    public function __construct(){
        $this->model = new tipo_pagamento();
    }

    public function listar(){
        $tipo_pagamentos = $this->model->listaTodos();  
        include "view/listartipo_pagamento.php";
    }

    public function listarCb() {
        return $this->model->listaTodos();
    }

    public function cadastrar($nr_parcelas, $prazo_primeira, $intervalo, $nome, $juros){
        // Validação: verifica se nome já existe
        if ($this->model->nomeExiste($nome)) {
            header("Location: tipo_pagamento.php?mensagem=❌ Nome já cadastrado!&tipo=danger");
            exit;
        }

        if ($this->model->cadastrar($nr_parcelas, $prazo_primeira, $intervalo, $nome, $juros)) {
            header("Location: tipo_pagamento.php?mensagem=✅ Tipo de pagamento cadastrado com sucesso!&tipo=success");
            exit;
        } else {
            header("Location: tipo_pagamento.php?mensagem=❌ Erro ao cadastrar tipo de pagamento!&tipo=danger");
            exit;
        }
    }

    public function buscaId($id){
        $tipo_pagamento = $this->model->listaId($id);
        include "view/formtipo_pagamento.php";
    }

    public function alterar($id, $nr_parcelas, $prazo_primeira, $intervalo, $nome, $juros){
        // Validação: verifica se nome já existe para outro registro
        if ($this->model->nomeExiste($nome, $id)) {
            header("Location: tipo_pagamento.php?acao=editar&id=$id&mensagem=❌ Nome já cadastrado para outro tipo!&tipo=danger");
            exit;
        }

        if ($this->model->alterar($nr_parcelas, $prazo_primeira, $intervalo, $nome, $juros, $id)) {
            header("Location: tipo_pagamento.php?mensagem=✅ Tipo de pagamento atualizado com sucesso!&tipo=success");
            exit;
        } else {
            header("Location: tipo_pagamento.php?acao=editar&id=$id&mensagem=❌ Erro ao atualizar tipo de pagamento!&tipo=danger");
            exit;
        }
    }

    public function excluir($id){
        if ($this->model->excluir($id)) {
            header("Location: tipo_pagamento.php?mensagem=✅ Tipo de pagamento excluído com sucesso!&tipo=success");
            exit;
        } else {
            header("Location: tipo_pagamento.php?mensagem=❌ Erro ao excluir tipo de pagamento!&tipo=danger");
            exit;
        }
    }
}
?>

