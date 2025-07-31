<?php
require_once "model/funcionario.php";

class funcionarioController {
    private $model;

    public function __construct(){
        $this->model = new Funcionario();
    }

    public function listar(){
        $funcionarios = $this->model->listaTodos();  
        include "view/listarFuncionario.php";
    }

    public function listarCb() {
        return $this->model->listaTodos();
    }

    public function cadastrar($nome, $tipo_funcionario, $telefone, $email, $logradouro, $numero, $bairro,
    $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado){
        // Verifica CPF duplicado antes de cadastrar
        if ($this->model->cpfExiste($cpf)) {
            header("Location: funcionario.php?mensagem=❌ CPF já cadastrado!&tipo=danger");
            exit;
        }

        $this->model->cadastrar($nome, $tipo_funcionario, $telefone, $email, $logradouro, $numero,
            $bairro, $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado);
        header("Location: funcionario.php?mensagem=✅ Funcionário cadastrado com sucesso!&tipo=success");
        exit;
    }

    public function buscaId($id){
        $funcionario = $this->model->listaId($id);
        include "view/formFuncionario.php";
    }

    public function alterar($id, $nome, $tipo_funcionario, $telefone, $email, $logradouro, $numero, $bairro, 
    $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado){
        // Verifica CPF duplicado, ignorando o funcionário atual
        if ($this->model->cpfExiste($cpf, $id)) {
            header("Location: funcionario.php?acao=editar&id=$id&mensagem=❌ CPF já cadastrado para outro funcionário!&tipo=danger");
            exit;
        }

        $this->model->alterar($nome, $tipo_funcionario, $telefone, $email, $logradouro, $numero, $bairro,
            $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado, $id);
        header("Location: funcionario.php?mensagem=✅ Funcionário atualizado com sucesso!&tipo=success");
        exit;
    }

    public function excluir($id){
    if ($this->model->excluir($id)) {
        header("Location: funcionario.php?mensagem=✅ Funcionário excluído com sucesso!&tipo=success");
    } else {
        header("Location: funcionario.php?mensagem=❌ Erro ao excluir funcionário!&tipo=danger");
    }
    exit;
    }

}
?>
