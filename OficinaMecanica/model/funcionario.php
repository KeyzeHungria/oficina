<?php
require_once 'config/conexao.php';

class Funcionario {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    public function listaTodos(){
        $result = $this->pdo->query("SELECT * FROM funcionario");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaId($id){
        $result = $this->pdo->prepare("SELECT * FROM funcionario WHERE idfuncionario = ?");
        $result->execute([$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $tipo_funcionario, $telefone, $email, $logradouro, $numero, $bairro, 
    $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado){
        $result = $this->pdo->prepare("INSERT INTO funcionario VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $result->execute([$nome, $tipo_funcionario, $telefone, $email, $logradouro, $numero, $bairro, 
        $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado]);
    }

    public function alterar($nome, $tipo_funcionario, $telefone, $email, $logradouro, $numero, $bairro, 
    $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado, $id){
        $result = $this->pdo->prepare("UPDATE funcionario SET nome=?, tipo_funcionario=?, telefone=?, email=?, logradouro=?, numero=?,
        bairro=?, complemento=?, cep=?, cpf=?, data_de_nascimento=?, cidade=?, estado=?
        WHERE idfuncionario = ?");
        return $result->execute([$nome, $tipo_funcionario, $telefone, $email, $logradouro, $numero, $bairro, 
        $complemento, $cep, $cpf, $data_de_nascimento, $cidade, $estado, $id]);
    }

    public function excluir($id){
        $result = $this->pdo->prepare("DELETE FROM funcionario WHERE idfuncionario = ?");
        return $result->execute([$id]);
    }

    // Método para verificar se CPF já existe, ignorando opcionalmente um ID
    public function cpfExiste($cpf, $idExcluir = null) {
        $sql = "SELECT COUNT(*) AS total FROM funcionario WHERE cpf = ?";
        $params = [$cpf];

        if ($idExcluir !== null) {
            $sql .= " AND idfuncionario != ?";
            $params[] = $idExcluir;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res['total'] > 0;
    }
}
?>
