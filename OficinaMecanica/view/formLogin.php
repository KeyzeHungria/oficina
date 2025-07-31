<?php if (!empty($erro)): ?>
    <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
<?php endif; ?>

<form action="login.php" method="post">

  <label for="login">Login</label>
  <input type="text" name="login" id="login" required>

  <label for="senha">Senha</label>
  <input type="password" name="senha" id="senha" required>

  <input type="submit" value="Entrar">

</form>

<a href="index.php">Voltar</a>

