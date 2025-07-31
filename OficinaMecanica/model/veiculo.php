<?php
require_once 'config/conexao.php';

class Veiculo {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos() {
        $result = $this->pdo->query("SELECT * FROM veiculo");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaId($id) {
        $result = $this->pdo->prepare("SELECT * FROM veiculo WHERE idveiculo = ?");
        $result->execute([$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($modelo, $ano, $placa, $chassi, $marca, $idcliente) {
        $result = $this->pdo->prepare("INSERT INTO veiculo VALUES (null, ?, ?, ?, ?, ?, ?)");
        return $result->execute([$modelo, $ano, $placa, $chassi, $marca, $idcliente]);
    }

    public function alterar($modelo, $ano, $placa, $chassi, $marca, $idcliente, $id) {
        $result = $this->pdo->prepare("UPDATE veiculo SET modelo = ?, ano = ?, placa = ?, chassi = ?, marca = ?, idcliente = ? WHERE idveiculo = ?");
        return $result->execute([$modelo, $ano, $placa, $chassi, $marca, $idcliente, $id]);
    }

    // Método para excluir veículo
    public function excluir($id) {
        $result = $this->pdo->prepare("DELETE FROM veiculo WHERE idveiculo = ?");
        return $result->execute([$id]);
    }

    // Verificações de existência para placa e chassi (cadastro e edição)
    public function placaExiste($placa) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM veiculo WHERE placa = ?");
        $stmt->execute([$placa]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }

    public function chassiExiste($chassi) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM veiculo WHERE chassi = ?");
        $stmt->execute([$chassi]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }

    public function placaExisteEmOutroVeiculo($placa, $idAtual) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM veiculo WHERE placa = ? AND idveiculo != ?");
        $stmt->execute([$placa, $idAtual]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }

    public function chassiExisteEmOutroVeiculo($chassi, $idAtual) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM veiculo WHERE chassi = ? AND idveiculo != ?");
        $stmt->execute([$chassi, $idAtual]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }
}
?>

