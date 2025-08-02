<?php
require_once "model/usuario.php";

class minhacontaController {
    private $model;

    public function __construct() {
        $this->model = new Usuario();
    }

    public function editar() {
        // Sessão e verificação de login já feitos no menu.php
        $id = $_SESSION["usuario_id"];
        $usuario = $this->model->listaId($id);

        include "menu.php";
        include "view/formMinhaConta.php";

        echo '
        <footer class="bg-dark text-white text-center py-3 fixed-bottom">
          Sistema Oficina Mão na Graxa &copy; ' . date('Y') . ' — Desenvolvido por Gabriella Louzada
        </footer>
        ';
    }

    public function atualizar($nome, $email, $login, $novaSenha) {
        // Sessão já iniciada e login verificado no menu.php
        $id = $_SESSION["usuario_id"];
        $usuarioAtual = $this->model->listaId($id);

        // Verifica se login já está em uso por outro usuário
        $usuarioExistente = $this->model->buscaPorLogin($login);
        if ($usuarioExistente && $usuarioExistente["idusuario"] != $id) {
            header("Location: minha_conta.php?acao=editar&erro=login_duplicado");
            exit();
        }

        if (!empty($novaSenha)) {
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $this->model->alterarComSenha($senhaHash, $nome, $email, $login, $usuarioAtual["tipo"], $id);
        } else {
            $this->model->alterarSemSenha($usuarioAtual["senha"], $nome, $email, $login, $usuarioAtual["tipo"], $id);
        }

        // Atualiza sessão
        $_SESSION["usuario_nome"] = $nome;
        $_SESSION["usuario_login"] = $login;

        header("Location: minha_conta.php?acao=editar&sucesso=1");
        exit();
    }

    public function excluirConta() {
        // Sessão já iniciada e login verificado no menu.php
        $this->model->excluir($_SESSION["usuario_id"]);
        session_unset();
        session_destroy();

        header("Location: login.php");
        exit();
    }
}

