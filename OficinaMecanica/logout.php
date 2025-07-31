<?php
session_start();          // Inicia a sessão (necessário para destruí-la)
session_unset();          // Limpa todas as variáveis de sessão
session_destroy();        // Destroi a sessão atual

header("Location: login.php"); // Redireciona para a tela de login
exit();
?>
