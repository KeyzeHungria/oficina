<?php
require_once 'config/conexao.php';

class Tipo_pagamento {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos(){
        try {
            $result = $this->pdo->query("SELECT * FROM tipo_pagamento");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar tipos de pagamento: ' . $e->getMessage());
            return [];
        }
    }

    public function listaId($id){
        try {
            $result = $this->pdo->prepare("SELECT * FROM tipo_pagamento WHERE idtipo_pagamento = ?");
            $result->execute([$id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar tipo de pagamento por ID: ' . $e->getMessage());
            return null;
        }
    }

    public function cadastrar($nr_parcelas, $prazo_primeira, $intervalo, $nome, $juros){
        try {
            $result = $this->pdo->prepare("
                INSERT INTO tipo_pagamento 
                (nr_parcelas, prazo_primeira, intervalo, nome, juros) 
                VALUES (?, ?, ?, ?, ?)
            ");
            return $result->execute([$nr_parcelas, $prazo_primeira, $intervalo, $nome, $juros]);
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar tipo de pagamento: ' . $e->getMessage());
            return false;
        }
    }

    public function alterar($nr_parcelas, $prazo_primeira, $intervalo, $nome, $juros, $id){
        try {
            $result = $this->pdo->prepare("
                UPDATE tipo_pagamento SET 
                nr_parcelas = ?, 
                prazo_primeira = ?, 
                intervalo = ?, 
                nome = ?, 
                juros = ?
                WHERE idtipo_pagamento = ?
            ");
            return $result->execute([$nr_parcelas, $prazo_primeira, $intervalo, $nome, $juros, $id]);
        } catch (PDOException $e) {
            error_log('Erro ao alterar tipo de pagamento: ' . $e->getMessage());
            return false;
        }
    }

    public function excluir($id){
        try {
            $result = $this->pdo->prepare("DELETE FROM tipo_pagamento WHERE idtipo_pagamento = ?");
            return $result->execute([$id]);
        } catch (PDOException $e) {
            error_log('Erro ao excluir tipo de pagamento: ' . $e->getMessage());
            return false;
        }
    }

    // Verifica se já existe um tipo de pagamento com o mesmo nome (ignora um id específico se passado)
    public function nomeExiste($nome, $idExcluir = null){
        try {
            $sql = "SELECT COUNT(*) AS total FROM tipo_pagamento WHERE nome = ?";
            $params = [$nome];
            if ($idExcluir !== null) {
                $sql .= " AND idtipo_pagamento != ?";
                $params[] = $idExcluir;
            }
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['total'] > 0;
        } catch (PDOException $e) {
            error_log('Erro ao verificar nome duplicado: ' . $e->getMessage());
            return false;
        }
    }
}
?>
