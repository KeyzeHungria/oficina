<?php
require_once "model/usuario.php";

class usuarioController {
    private $model;

    public function __construct(){
        $this->model = new Usuario();
    }

    public function listar(){
        $usuarios = $this->model->listaTodos();   
        include "view/listarUsuario.php";
    }

    public function listarCb(){
        $usuarios = $this->model->listaTodos();
        return $usuarios;
    }

    public function cadastrar($senha, $nome, $email, $login){
        // Verifica se o login já existe
        $usuarioExistente = $this->model->buscaPorLogin($login);
        if ($usuarioExistente) {
            header("location:usuario.php?erro=login_duplicado");
            exit;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $this->model->cadastrar($senhaHash, $nome, $email, $login);
        header("location:usuario.php?mensagem=Usuário cadastrado com sucesso&tipo=success");  
    }

    public function buscaId($id){
        $usuario = $this->model->listaId($id);
        include "view/formUsuario.php";
    }

    public function login($usuario, $senha){
        $usuario = $this->model->login($usuario, $senha);
        return $usuario;
    }

    public function alterar($id, $senha, $nome, $email, $login){
        $usuarioExistente = $this->model->buscaPorLogin($login);

        // Se existe outro usuário com o mesmo login (id diferente), bloqueia
        if ($usuarioExistente && $usuarioExistente['idusuario'] != $id) {
            header("location:usuario.php?erro=login_duplicado&id=$id");
            exit;
        }

        if (empty($senha)) {
            $usuarioAtual = $this->model->listaId($id);
            $senhaHashAtual = $usuarioAtual['senha'];
            $this->model->alterarSemSenha($senhaHashAtual, $nome, $email, $login, $id);
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $this->model->alterar($senhaHash, $nome, $email, $login, $id);
        }

        header("location:usuario.php?mensagem=Usuário atualizado com sucesso&tipo=success");
    }

    public function excluir($id){
        $this->model->excluir($id);
        header("location:usuario.php?mensagem=Usuário excluído com sucesso&tipo=success");
    }
}
?>

