<div class="container my-5">
  <h2>Minha Conta</h2>

  <?php if (isset($_GET["sucesso"])): ?>
    <div class="alert alert-success">Dados atualizados com sucesso!</div>
  <?php endif; ?>

  <?php if (isset($_GET["erro"])): ?>
    <div class="alert alert-danger">
      <?php
        if ($_GET["erro"] === "login_duplicado") echo "Este login já está sendo usado por outro usuário.";
        if ($_GET["erro"] === "senha_incorreta") echo "Senha atual incorreta.";
      ?>
    </div>
  <?php endif; ?>

  <form method="post" action="minha_conta.php?acao=atualizar">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($usuario["nome"]) ?>" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">E-mail</label>
      <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario["email"]) ?>" required>
    </div>

    <div class="mb-3">
      <label for="login" class="form-label">Login</label>
      <input type="text" id="login" name="login" class="form-control" value="<?= htmlspecialchars($usuario["login"]) ?>" required>
    </div>

    <div class="mb-3">
      <label for="senha" class="form-label">Nova Senha</label>
      <input type="password" id="senha" name="senha" class="form-control" placeholder="Deixe em branco para manter a senha atual">
    </div>

    <div class="mb-3">
      <label for="senha_atual" class="form-label">Confirme sua senha atual</label>
      <input type="password" id="senha_atual" name="senha_atual" class="form-control" required>
    </div>

    <div class="d-flex justify-content-between align-items-center">
      <button type="submit" class="btn btn-primary">Salvar Alterações</button>

      <?php if ($_SESSION["usuario_tipo"] === 'usuario'): ?>
        <form method="post" action="minha_conta.php?acao=excluir" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Essa ação não poderá ser desfeita.');">
          <button type="submit" class="btn btn-outline-danger">Excluir minha conta</button>
        </form>
      <?php endif; ?>
    </div>
  </form>
</div>


