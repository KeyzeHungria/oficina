<?php
require_once "model/usuario.php";

class usuarioController {
    private $model;

    public function __construct(){
        $this->model = new Usuario();
    }

    public function listar(){
        $usuarioTipo = $_SESSION["usuario_tipo"] ?? 'usuario';

        if ($usuarioTipo === 'admin') {
            $usuarios = $this->model->listaTodos();
        } else {
            $usuarios = [$this->model->listaId($_SESSION["usuario_id"])];
        }
        include "view/listarUsuario.php";
    }

    public function login($login, $senha) {
        return $this->model->login($login, $senha);
    }

    public function listarCb(){
        $usuarioTipo = $_SESSION["usuario_tipo"] ?? 'usuario';

        if ($usuarioTipo === 'admin') {
            return $this->model->listaTodos();
        } else {
            return [$this->model->listaId($_SESSION["usuario_id"])];
        }
    }

    public function buscaIdParaLista($id){
        return $this->model->listaId($id);
    }

    public function cadastrar($senha, $nome, $email, $login, $tipo){
        if (($_SESSION["usuario_tipo"] ?? 'usuario') !== 'admin') {
            header("location:usuario.php?erro=permissao_negada");
            exit;
        }

        $usuarioExistente = $this->model->buscaPorLogin($login);
        if ($usuarioExistente) {
            header("location:usuario.php?erro=login_duplicado");
            exit;
        }

        $this->model->cadastrar($senha, $nome, $email, $login, $tipo);
        header("location:usuario.php?mensagem=Usuário cadastrado com sucesso&tipo=success");
        exit;
    }

    public function buscaId($id){
        $usuarioTipo = $_SESSION["usuario_tipo"] ?? 'usuario';
        $usuarioIdLogado = $_SESSION["usuario_id"] ?? 0;

        if ($usuarioTipo !== 'admin' && $id != $usuarioIdLogado) {
            header("location:usuario.php?erro=permissao_negada");
            exit;
        }

        $usuario = $this->model->listaId($id);
        include "view/formUsuario.php";
    }

    public function alterar($id, $senha, $nome, $email, $login, $tipo){
        $usuarioTipo = $_SESSION["usuario_tipo"] ?? 'usuario';
        $usuarioIdLogado = $_SESSION["usuario_id"] ?? 0;

        if ($usuarioTipo !== 'admin' && $id != $usuarioIdLogado) {
            header("location:usuario.php?erro=permissao_negada");
            exit;
        }

        if ($usuarioTipo !== 'admin') {
            $tipo = $this->model->listaId($id)['tipo'];
        }

        $usuarioExistente = $this->model->buscaPorLogin($login);
        if ($usuarioExistente && $usuarioExistente['idusuario'] != $id) {
            header("location:usuario.php?erro=login_duplicado&id=$id");
            exit;
        }

        if (empty($senha)) {
            $usuarioAtual = $this->model->listaId($id);
            $senhaHashAtual = $usuarioAtual['senha'];
            $this->model->alterarSemSenha($senhaHashAtual, $nome, $email, $login, $tipo, $id);
        } else {
            $this->model->alterarComSenha($senha, $nome, $email, $login, $tipo, $id);
        }

        if ($id == $usuarioIdLogado) {
            $_SESSION["usuario_nome"] = $nome;
            $_SESSION["usuario_login"] = $login;
        }

        header("location:usuario.php?mensagem=Usuário atualizado com sucesso&tipo=success");
        exit;
    }

    public function excluir($id){
        if (($_SESSION["usuario_tipo"] ?? 'usuario') !== 'admin') {
            header("location:usuario.php?erro=permissao_negada");
            exit;
        }

        $this->model->excluir($id);
        header("location:usuario.php?mensagem=Usuário excluído com sucesso&tipo=success");
        exit;
    }
}




