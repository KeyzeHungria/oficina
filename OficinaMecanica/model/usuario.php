<?php
require_once 'config/conexao.php';

class Usuario {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos(){
        $result = $this->pdo->query("SELECT * FROM usuario");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaId($id){
        $result = $this->pdo->prepare("SELECT * FROM usuario WHERE idusuario = ?");
        $result->execute([$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

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

    public function cadastrar($senha, $nome, $email, $login){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $result = $this->pdo->prepare("INSERT INTO usuario VALUES (null, ?, ?, ?, ?)");
        return $result->execute([$senhaHash, $nome, $email, $login]);
    }

    public function alterar($senha, $nome, $email, $login, $id){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $result = $this->pdo->prepare("UPDATE usuario SET senha=?, nome=?, email=?, login=? WHERE idusuario = ?");
        return $result->execute([$senhaHash, $nome, $email, $login, $id]);
    }

    public function alterarSemSenha($senhaAtual, $nome, $email, $login, $id) {
        $result = $this->pdo->prepare("UPDATE usuario SET senha=?, nome=?, email=?, login=? WHERE idusuario = ?");
        return $result->execute([$senhaAtual, $nome, $email, $login, $id]);
    }

    public function excluir($id){
        $result = $this->pdo->prepare("DELETE FROM usuario WHERE idusuario = ?");
        return $result->execute([$id]);
    }

    // ✅ NOVO: Verifica se o login já está cadastrado
    public function buscaPorLogin($login) {
        $result = $this->pdo->prepare("SELECT * FROM usuario WHERE login = ?");
        $result->execute([$login]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
?>

