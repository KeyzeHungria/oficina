
<form method="post">  
    <input type="hidden" name="acao" value="cadastrar">

    <label>Forma de pagamento:</label>
    <select name="idtipo_pagamento" required>
        <?php foreach($tipopagamentos as $tipopagamento): ?>
            <option value="<?= $servico['idtipo_pagamento'] ?>">
                <?= $servico['nome'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

 
    <input type="submit" value="Salvar">
</form>
<?php
    if(isset($_POST["idtipo_pagamento"])){
        $idservico = $_GET["idservico"];
    }
?>
<a href="servicoFuncionario.php">Voltar</a>