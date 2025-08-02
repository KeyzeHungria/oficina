<?php
require_once 'config/conexao.php';

class Usuario {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    // Lista todos os usuários
    public function listaTodos(){
        $result = $this->pdo->query("SELECT * FROM usuario");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca um usuário por ID
    public function listaId($id){
        $result = $this->pdo->prepare("SELECT * FROM usuario WHERE idusuario = ?");
        $result->execute([$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Realiza o login
    public function login($usuario, $senha){
        $result = $this->pdo->prepare("SELECT * FROM usuario WHERE login = ?");
        $result->execute([$usuario]);
        $usuarioEncontrado = $result->fetch(PDO::FETCH_ASSOC);

        if ($usuarioEncontrado && password_verify($senha, $usuarioEncontrado['senha'])) {
            return $usuarioEncontrado;
        } else {
            return false;
        }
    }

    // Cadastra novo usuário com tipo (padrão = usuario)
    public function cadastrar($senha, $nome, $email, $login, $tipo = 'usuario'){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $result = $this->pdo->prepare("INSERT INTO usuario (senha, nome, email, login, tipo) VALUES (?, ?, ?, ?, ?)");
        return $result->execute([$senhaHash, $nome, $email, $login, $tipo]);
    }

    // Altera usuário com nova senha e tipo (renomeado para alterarComSenha)
    public function alterarComSenha($senha, $nome, $email, $login, $tipo, $id){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $result = $this->pdo->prepare("UPDATE usuario SET senha=?, nome=?, email=?, login=?, tipo=? WHERE idusuario = ?");
        return $result->execute([$senhaHash, $nome, $email, $login, $tipo, $id]);
    }

    // Altera usuário sem trocar senha, mas atualiza tipo
    public function alterarSemSenha($senhaAtual, $nome, $email, $login, $tipo, $id) {
        $result = $this->pdo->prepare("UPDATE usuario SET senha=?, nome=?, email=?, login=?, tipo=? WHERE idusuario = ?");
        return $result->execute([$senhaAtual, $nome, $email, $login, $tipo, $id]);
    }

    // Exclui usuário
    public function excluir($id){
        $result = $this->pdo->prepare("DELETE FROM usuario WHERE idusuario = ?");
        return $result->execute([$id]);
    }

    // Verifica se login já existe
    public function buscaPorLogin($login) {
        $result = $this->pdo->prepare("SELECT * FROM usuario WHERE login = ?");
        $result->execute([$login]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
?>




