<?php
require_once 'config/conexao.php';

class Servico {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    // Lista todos os serviços
    public function listaTodos(){
        $result = $this->pdo->query("SELECT * FROM servico ORDER BY idservico DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lista serviços com informações de cliente, veículo e agendamento
    public function listaComClienteEVeiculo(){
        $sql = "
            SELECT s.*,
                   c.nome AS nome_cliente,
                   v.placa AS placa_veiculo,
                   a.data AS data_agendamento,
                   a.horario
            FROM servico s
            INNER JOIN cliente c ON s.idcliente = c.idcliente
            INNER JOIN veiculo v ON s.idveiculo = v.idveiculo
            INNER JOIN agendamento a ON s.idagendamento = a.idagendamento
            ORDER BY s.idservico DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca um serviço por ID
    public function listaId($id){
        $stmt = $this->pdo->prepare("SELECT * FROM servico WHERE idservico = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cadastra um novo serviço
    public function cadastrar($tipo_servico, $descricao, $idcliente, $idveiculo, $status_servico, $idtipo_pagamento, $mao_obra, $valor_total = null, $idagendamento){
        $sql = "INSERT INTO servico (
                    tipo_servico, descricao, idcliente, idveiculo, status_servico, idtipo_pagamento, mao_obra, valor_total, pagamento_gerado, idagendamento
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $tipo_servico, 
            $descricao, 
            $idcliente, 
            $idveiculo, 
            $status_servico, 
            $idtipo_pagamento, 
            $mao_obra, 
            $valor_total,
            $idagendamento
        ]);
    }

    // Altera um serviço existente
    public function alterar($tipo_servico, $descricao, $idcliente, $idveiculo, $status_servico, $idtipo_pagamento, $mao_obra, $valor_total, $id, $idagendamento){
        $sql = "UPDATE servico 
                SET tipo_servico=?, descricao=?, idcliente=?, idveiculo=?, status_servico=?, idtipo_pagamento=?, mao_obra=?, valor_total=?, idagendamento=?
                WHERE idservico = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $tipo_servico, 
            $descricao, 
            $idcliente, 
            $idveiculo, 
            $status_servico, 
            $idtipo_pagamento, 
            $mao_obra, 
            $valor_total,
            $idagendamento,
            $id
        ]);
    }

    // Exclui um serviço
    public function excluir($id){
        $stmt = $this->pdo->prepare("DELETE FROM servico WHERE idservico = ?");
        return $stmt->execute([$id]);
    }

    // Calcula o valor total de um serviço com base na soma dos subtotais + mão de obra
    public function calcularValorTotal($idservico) {
        $sql = "
            SELECT
                COALESCE(SUM(i.subtotal), 0) AS total_itens,
                COALESCE(s.mao_obra, 0) AS mao_obra
            FROM servico s
            LEFT JOIN item_servico i ON s.idservico = i.idservico
            WHERE s.idservico = ?
            GROUP BY s.idservico, s.mao_obra
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idservico]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return 0;
        }

        return floatval($row['total_itens']) + floatval($row['mao_obra']);
    }

    // Atualiza o campo valor_total no banco
    public function atualizarValorTotal($idservico, $valor_total){
        $sql = "UPDATE servico SET valor_total = ? WHERE idservico = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$valor_total, $idservico]);
    }

    // Atualiza o valor_total automaticamente com base nos itens cadastrados
    public function atualizarTotalAutomatico($idservico){
        $valorTotal = $this->calcularValorTotal($idservico);
        return $this->atualizarValorTotal($idservico, $valorTotal);
    }
}
?>









