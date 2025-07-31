<?php
    require_once 'config/conexao.php';     /*o require_once vai requisitar esse arquivo, mas somente uma vez*/

    class Produto {
        private $pdo;

        public function __construct()
        {
            $this->pdo = Conexao::conectar();     /*o pdo é um atributo, que chama o método conectar da classe Conexao*/
        }

        public function baixoEstoque($quantidade){
            $result = $this->pdo->prepare(
                "SELECT nome, quantidade
                FROM produto WHERE quantidade < ?");
            $result->execute([$quantidade]);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listaTodos(){
            $result = $this->pdo->query(   /*result: é o retorno do banco de dados*/
                "SELECT * FROM produto");
            return $result->fetchAll(
                PDO::FETCH_ASSOC);   /*pega a variável(tabela) e transforma em um vetor associativo*/
        }

        public function listaId($id){    /*traz os dados de um cliente específico*/
            $result = $this->pdo->prepare("SELECT * FROM produto WHERE idproduto = ?");  /* o prepare vai preparar a consulta, pq não está passando o parâmetro imediatamente*/
            $result->execute([$id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        public function cadastrar($nome, $quantidade, $data_entrada, $data_saida, $modelo, $marca, $ano, $preco, $lote, $data_vencimento){
            $result = $this->pdo->prepare("INSERT INTO produto VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            return $result->execute([$nome, $quantidade, $data_entrada, $data_saida, $modelo, $marca, 
            $ano, $preco, $lote, $data_vencimento]);
        }

        public function alterar($nome, $quantidade, $data_entrada, $data_saida, $modelo, $marca, 
            $ano, $preco, $lote, $data_vencimento, $id){
            $result = $this->pdo->prepare("UPDATE produto SET nome=?, quantidade=?, data_entrada=?, data_saida=?, modelo=?,
            marca=?, ano=?, preco=?, lote=?, data_vencimento=?
            WHERE idproduto = ?");
            return $result->execute([$nome, $quantidade, $data_entrada, $data_saida, $modelo, $marca, 
            $ano, $preco, $lote, $data_vencimento, $id]);
        }

        public function excluir($id){
            $result = $this->pdo->prepare("DELETE FROM produto WHERE idproduto = ?");
            return $result->execute([$id]);
        }

    }
?>