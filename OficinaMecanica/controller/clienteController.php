<?php
require_once "model/cliente.php";

class clienteController {
    private $model;

    public function __construct(){
        $this->model = new Cliente();
    }

    public function listar(){
        $clientes = $this->model->listaTodos();   
        include "view/listarCliente.php";
    }

    public function listarCb(){
        $clientes = $this->model->listaTodos();
        return $clientes;
    }

    public function cadastrar($nome, $telefone, $email, $logradouro, $numero, $bairro, 
    $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado){
        // Verifica CPF duplicado antes de cadastrar
        if ($this->model->cpfExiste($cpf)) {
            header("Location: cliente.php?mensagem=❌ CPF já cadastrado!&tipo=danger");
            exit;
        }

        $this->model->cadastrar($nome, $telefone, $email, $logradouro, $numero,
            $bairro, $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado);
        header("Location: cliente.php?mensagem=✅ Cliente cadastrado com sucesso!&tipo=success");
        exit;  
    }

    public function buscaId($id){
        $cliente = $this->model->listaId($id);
        include "view/formCliente.php";
    }

    public function alterar($id, $nome, $telefone, $email, $logradouro, $numero, $bairro, 
    $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado){
        // Verifica CPF duplicado, ignorando o cliente atual
        if ($this->model->cpfExiste($cpf, $id)) {
            header("Location: cliente.php?acao=editar&id=$id&mensagem=❌ CPF já cadastrado para outro cliente!&tipo=danger");
            exit;
        }

        $this->model->alterar($nome, $telefone, $email, $logradouro, $numero, $bairro, 
            $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado, $id);
        header("Location: cliente.php?mensagem=✅ Cliente atualizado com sucesso!&tipo=success");
        exit;
    }

    public function excluir($id){
        if ($this->model->excluir($id)) {
            header("Location: cliente.php?mensagem=✅ Cliente excluído com sucesso!&tipo=success");
        } else {
            header("Location: cliente.php?mensagem=❌ Erro ao excluir cliente!&tipo=danger");
        }
        exit;
    }
}
?>
