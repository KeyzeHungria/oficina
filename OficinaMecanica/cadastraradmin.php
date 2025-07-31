<?php
 require_once "model/usuario.php";
 $usuario = new Usuario();
 $usuario ->  cadastrar("admin123", "admin", "", "admin");
?>