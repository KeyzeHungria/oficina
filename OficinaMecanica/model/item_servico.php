<?php
require_once 'config/conexao.php';

class item_servico {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos() {
        $sql = "SELECT i.*, 
                       p.nome AS produtos, 
                       s.tipo_servico AS tipo_servico 
                FROM item_servico AS i
                INNER JOIN servico AS s ON i.idservico = s.idservico
                INNER JOIN produto AS p ON i.idproduto = p.idproduto
                ORDER BY i.idservico DESC, i.idproduto DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaId($idproduto, $idservico) {
        $sql = "SELECT * FROM item_servico WHERE idproduto = ? AND idservico = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idproduto, $idservico]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function existe($idproduto, $idservico) {
        $sql = "SELECT COUNT(*) FROM item_servico WHERE idproduto = ? AND idservico = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idproduto, $idservico]);
        return $stmt->fetchColumn() > 0;
    }

    public function cadastrar($idproduto, $idservico, $codigo_item, $qtd_pecas_utilizadas, $preco_unitario, $subtotal) {
        try {
            $sql = "INSERT INTO item_servico 
                    (idproduto, idservico, codigo_item, qtd_pecas_utilizadas, preco_unitario, subtotal) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$idproduto, $idservico, $codigo_item, $qtd_pecas_utilizadas, $preco_unitario, $subtotal]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function alterar($idproduto, $idservico, $codigo_item, $qtd_pecas_utilizadas, $preco_unitario, $subtotal) {
        try {
            $sql = "UPDATE item_servico 
                    SET codigo_item = ?, qtd_pecas_utilizadas = ?, preco_unitario = ?, subtotal = ?
                    WHERE idproduto = ? AND idservico = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$codigo_item, $qtd_pecas_utilizadas, $preco_unitario, $subtotal, $idproduto, $idservico]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function excluir($idproduto, $idservico) {
        try {
            $sql = "DELETE FROM item_servico WHERE idproduto = ? AND idservico = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$idproduto, $idservico]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // ✅ NOVO MÉTODO: Lista todos os itens de um serviço específico
    public function listarPorServico($idservico) {
        $sql = "SELECT * FROM item_servico WHERE idservico = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idservico]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
