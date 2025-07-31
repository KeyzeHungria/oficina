<?php 
    class Conexao{
        public static function conectar(){
           try{ 
             return new PDO("mysql:host=localhost;dbname=oficina","root", "root"); 
           } catch (PDOException $e){
             die("Erro: ".$e->getMessage());  
           }
        }
    }