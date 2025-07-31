<?php
require_once 'config/conexao.php';

class Servico_funcionario {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos() {
        $sql = "SELECT sf.idservico, sf.idfuncionario,
                       s.tipo_servico, f.nome
                FROM servico_funcionario sf
                INNER JOIN servico s ON sf.idservico = s.idservico
                INNER JOIN funcionario f ON sf.idfuncionario = f.idfuncionario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($idservico, $idfuncionario) {
        // Verifica se já existe associação para evitar duplicidade
        $sqlCheck = "SELECT * FROM servico_funcionario WHERE idservico = ? AND idfuncionario = ?";
        $stmtCheck = $this->pdo->prepare($sqlCheck);
        $stmtCheck->execute([$idservico, $idfuncionario]);
        if ($stmtCheck->rowCount() > 0) {
            return false;
        }

        $sql = "INSERT INTO servico_funcionario (idservico, idfuncionario) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$idservico, $idfuncionario]);
    }

    public function excluir($idservico, $idfuncionario) {
        $sql = "DELETE FROM servico_funcionario WHERE idservico = ? AND idfuncionario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$idservico, $idfuncionario]);
    }

    public function listaId($idservico, $idfuncionario) {
        $sql = "SELECT * FROM servico_funcionario WHERE idservico = ? AND idfuncionario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idservico, $idfuncionario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
