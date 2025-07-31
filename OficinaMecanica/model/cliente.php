<?php
require_once 'config/conexao.php';

class Cliente {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos(){
        try {
            $result = $this->pdo->query("SELECT * FROM cliente");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar clientes: ' . $e->getMessage());
            return [];
        }
    }

    public function listaId($id){
        try {
            $result = $this->pdo->prepare("SELECT * FROM cliente WHERE idcliente = ?");
            $result->execute([$id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar cliente por ID: ' . $e->getMessage());
            return null;
        }
    }

    public function cadastrar($nome, $telefone, $email, $logradouro, $numero, $bairro, 
    $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado){
        try {
            $result = $this->pdo->prepare("INSERT INTO cliente VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            return $result->execute([$nome, $telefone, $email, $logradouro, $numero, $bairro, 
                $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado]);
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar cliente: ' . $e->getMessage());
            return false;
        }
    }

    public function alterar($nome, $telefone, $email, $logradouro, $numero, $bairro, 
    $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado, $id){
        try {
            $result = $this->pdo->prepare("UPDATE cliente SET nome=?, telefone=?, email=?, logradouro=?, numero=?,
                bairro=?, complemento=?, cep=?, cpf=?, data_de_nascimento=?, cidade=?, estado=?
                WHERE idcliente = ?");
            return $result->execute([$nome, $telefone, $email, $logradouro, $numero, $bairro, 
                $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado, $id]);
        } catch (PDOException $e) {
            error_log('Erro ao alterar cliente: ' . $e->getMessage());
            return false;
        }
    }

    public function excluir($id){
        try {
            $result = $this->pdo->prepare("DELETE FROM cliente WHERE idcliente = ?");
            return $result->execute([$id]);
        } catch (PDOException $e) {
            error_log('Erro ao excluir cliente: ' . $e->getMessage());
            return false;
        }
    }

    // Método para verificar se CPF já existe (excluindo opcionalmente o id atual)
    public function cpfExiste($cpf, $idExcluir = null) {
        try {
            $sql = "SELECT COUNT(*) AS total FROM cliente WHERE cpf = ?";
            $params = [$cpf];

            if ($idExcluir !== null) {
                $sql .= " AND idcliente != ?";
                $params[] = $idExcluir;
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            return $res['total'] > 0;
        } catch (PDOException $e) {
            error_log('Erro ao verificar CPF: ' . $e->getMessage());
            return false;
        }
    }
}
?>
