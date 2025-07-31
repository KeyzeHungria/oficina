<?php
require_once "model/pagamento.php";

class pagamentoController {
    private $model;

    public function __construct() {
        $this->model = new Pagamento();
    }

    public function listar() {
        $pagamentos = $this->model->listaTodos();   
        include "view/listarPagamento.php";
    }

    public function listarCb() {
        return $this->model->listaTodos();
    }

    public function cadastrar($valor_parcela, $data_pagamento, $status_pagamento, $idservico, $valor_pago) {
        $this->model->cadastrar($valor_parcela, $data_pagamento, $status_pagamento, $idservico, $valor_pago);
        header("Location: pagamento.php?mensagem=✅ Pagamento cadastrado com sucesso!&tipo=success");
        exit;
    }

    public function buscaId($id, $servicos) {
        $pagamento = $this->model->listaId($id);
        include "view/formPagamento.php";
    }

    public function alterar($id, $valor_parcela, $data_pagamento, $status_pagamento, $idservico, $valor_pago) {
        $this->model->alterar($valor_parcela, $data_pagamento, $status_pagamento, $idservico, $valor_pago, $id);
        header("Location: pagamento.php?mensagem=✅ Pagamento atualizado com sucesso!&tipo=success");
        exit;
    }

    public function excluir($id) {
        if ($this->model->excluir($id)) {
            header("Location: pagamento.php?mensagem=✅ Pagamento excluído com sucesso!&tipo=success");
        } else {
            header("Location: pagamento.php?mensagem=❌ Erro ao excluir pagamento!&tipo=danger");
        }
        exit;
    }
}

?>
