<?php
require_once 'config/conexao.php';

class Pagamento {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos(){
        $result = $this->pdo->query(
            "SELECT p.*, s.tipo_servico
             FROM pagamento AS p
             INNER JOIN servico AS s ON p.idservico = s.idservico"
        );
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaId($id){
        $result = $this->pdo->prepare("SELECT * FROM pagamento WHERE idpagamento = ?");
        $result->execute([$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($valor_parcela, $data_pagamento, $status_pagamento, $idservico, $valor_pago){
        $sql = "INSERT INTO pagamento 
                (valor_parcela, data_pagamento, status_pagamento, idservico, valor_pago) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$valor_parcela, $data_pagamento, $status_pagamento, $idservico, $valor_pago]);
    }

    public function alterar($valor_parcela, $data_pagamento, $status_pagamento, $idservico, $valor_pago, $id){
        $sql = "UPDATE pagamento SET 
                valor_parcela = ?, 
                data_pagamento = ?, 
                status_pagamento = ?, 
                idservico = ?, 
                valor_pago = ?
                WHERE idpagamento = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$valor_parcela, $data_pagamento, $status_pagamento, $idservico, $valor_pago, $id]);
    }

    public function excluir($id){
        $stmt = $this->pdo->prepare("DELETE FROM pagamento WHERE idpagamento = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0; // retorna true se foi excluído
    }
}
?>

