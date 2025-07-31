<?php
require_once "model/servico_funcionario.php";

class servico_funcionarioController {
    private $model;

    public function __construct() {
        $this->model = new Servico_funcionario();
    }

    public function listar() {
        $servico_funcionario = $this->model->listaTodos();
        include "view/listarservico_funcionario.php";
    }

    public function cadastrar($idservico, $idfuncionario) {
        $success = $this->model->cadastrar($idservico, $idfuncionario);
        if (!$success) {
            // Aqui pode tratar a mensagem de erro (ex: já existe)
            // Exemplo simples:
            $_SESSION['msg'] = "Essa associação já existe.";
        }
        header("Location: servico_funcionario.php");
        exit;
    }

    public function excluir($idservico, $idfuncionario) {
        $this->model->excluir($idservico, $idfuncionario);
        header("Location: servico_funcionario.php");
        exit;
    }
}
?>
