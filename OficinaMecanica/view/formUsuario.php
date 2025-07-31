<!-- Bootstrap CSS -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
  rel="stylesheet"
/>
<!-- Bootstrap Icons -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
  rel="stylesheet"
/>

<div class="container py-5">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0">
        <?= isset($usuario) ? 'Editar Usuário' : 'Cadastrar Usuário' ?>
      </h3>
    </div>

    <div class="card-body">

      <!-- 🔴 Exibir alerta de login duplicado -->
      <?php if (!empty($_GET['erro']) && $_GET['erro'] === 'login_duplicado'): ?>
        <div class="alert alert-danger" role="alert">
          Erro: Este login já está cadastrado no sistema.
        </div>
      <?php endif; ?>

      <form action="usuario.php" method="post" class="row g-3">
        <!-- ação e id ocultos -->
        <input type="hidden" name="acao" value="<?= isset($usuario) ? 'atualizar' : 'cadastrar' ?>" />
        <?php if (isset($usuario)) : ?>
          <input type="hidden" name="id" value="<?= $usuario['idusuario'] ?>" />
        <?php elseif (!empty($_GET['id'])) : ?>
          <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>" />
        <?php endif; ?>

        <div class="col-md-6">
          <label for="login" class="form-label">Login</label>
          <input
            type="text"
            class="form-control"
            id="login"
            name="login"
            value="<?= $_POST['login'] ?? $usuario['login'] ?? '' ?>"
            placeholder="Digite o login"
            required
          />
        </div>

        <div class="col-md-6">
          <label for="senha" class="form-label">Senha</label>
          <input
            type="password"
            class="form-control"
            id="senha"
            name="senha"
            placeholder="<?= isset($usuario) ? 'Deixe em branco para manter a atual' : 'Digite a senha' ?>"
          />
        </div>

        <div class="col-md-6">
          <label for="nome" class="form-label">Nome</label>
          <input
            type="text"
            class="form-control"
            id="nome"
            name="nome"
            value="<?= $_POST['nome'] ?? $usuario['nome'] ?? '' ?>"
            placeholder="Digite o nome completo"
            required
          />
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            value="<?= $_POST['email'] ?? $usuario['email'] ?? '' ?>"
            placeholder="email@exemplo.com"
            required
          />
        </div>

        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>
          <a href="usuario.php" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
