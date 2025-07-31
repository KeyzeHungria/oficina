<?php
require_once 'config/conexao.php';

class Agendamento {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos() {
        $sql = "
            SELECT a.*, 
                   c.nome AS cliente,
                   v.placa AS veiculo
            FROM agendamento AS a
            INNER JOIN cliente AS c ON a.idcliente = c.idcliente
            INNER JOIN veiculo AS v ON a.idveiculo = v.idveiculo
            ORDER BY a.data, a.horario
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Verifica se já existe conflito: mesmo cliente ou veículo no mesmo dia e hora
    public function conflitoExiste($data, $horario, $idcliente, $idveiculo, $id = null) {
        $sql = "
            SELECT COUNT(*) as total 
            FROM agendamento 
            WHERE data = :data 
              AND horario = :horario 
              AND (idcliente = :idcliente OR idveiculo = :idveiculo)
        ";

        if ($id !== null) {
            $sql .= " AND idagendamento != :idagendamento";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':idcliente', $idcliente);
        $stmt->bindParam(':idveiculo', $idveiculo);

        if ($id !== null) {
            $stmt->bindParam(':idagendamento', $id);
        }

        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] > 0;
    }

    // Conta quantos agendamentos existem na mesma data e hora (para limite 3)
    public function countAgendamentosNoHorario($data, $horario, $id = null) {
        $sql = "SELECT COUNT(*) as total FROM agendamento WHERE data = :data AND horario = :horario";

        if ($id !== null) {
            $sql .= " AND idagendamento != :idagendamento";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':horario', $horario);

        if ($id !== null) {
            $stmt->bindParam(':idagendamento', $id);
        }

        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$resultado['total'];
    }

    // Busca agendamentos no intervalo +/- 1 hora para evitar conflito de agendamento próximo
    public function buscaPorIntervalo($data, $inicio, $fim, $idcliente, $idveiculo, $id = null) {
    $sql = "
        SELECT * FROM agendamento 
        WHERE data = :data 
          AND horario BETWEEN :inicio AND :fim 
          AND (idcliente = :idcliente OR idveiculo = :idveiculo)
    ";

    if ($id !== null) {
        $sql .= " AND idagendamento != :idagendamento";
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':inicio', $inicio);
    $stmt->bindParam(':fim', $fim);
    $stmt->bindParam(':idcliente', $idcliente);
    $stmt->bindParam(':idveiculo', $idveiculo);

    if ($id !== null) {
        $stmt->bindParam(':idagendamento', $id);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM agendamento WHERE idagendamento = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($data, $horario, $status_agendamento, $idcliente, $idveiculo) {
        $stmt = $this->pdo->prepare("
            INSERT INTO agendamento (data, horario, status_agendamento, idcliente, idveiculo) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$data, $horario, $status_agendamento, $idcliente, $idveiculo]);
    }

    public function alterar($data, $horario, $status_agendamento, $idcliente, $idveiculo, $id) {
        $stmt = $this->pdo->prepare("
            UPDATE agendamento 
            SET data = ?, horario = ?, status_agendamento = ?, idcliente = ?, idveiculo = ? 
            WHERE idagendamento = ?
        ");
        return $stmt->execute([$data, $horario, $status_agendamento, $idcliente, $idveiculo, $id]);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM agendamento WHERE idagendamento = ?");
        return $stmt->execute([$id]);
    }
}
?>
