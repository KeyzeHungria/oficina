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
        <?= isset($cliente) ? 'Editar' : 'Cadastrar'; ?>
      </h3>
    </div>

    <div class="card-body">

      <!-- Mensagem de erro para CPF duplicado -->
      <?php if (!empty($_GET['erro']) && $_GET['erro'] === 'cpf_duplicado'): ?>
        <div class="alert alert-danger" role="alert">
          Erro: Este CPF já está cadastrado no sistema.
        </div>
      <?php endif; ?>

      <form
        action="cliente.php"
        method="post"
        class="row row-cols-1 row-cols-md-2 g-3"
      >
        <!-- ação e id (ocultos) -->
        <input
          type="hidden"
          name="acao"
          value="<?= isset($cliente) ? 'atualizar' : 'cadastrar'; ?>"
        />
        <?php if (isset($cliente)) : ?>
          <input
            type="hidden"
            name="id"
            value="<?= $cliente['idcliente']; ?>"
          />
        <?php endif; ?>

        <!-- Dados pessoais -->
        <div class="col">
          <label class="form-label">Nome</label>
          <input
            type="text"
            name="nome"
            class="form-control"
            value="<?= $cliente['nome'] ?? ''; ?>"
            placeholder="Digite o nome completo"
            required
          />
        </div>

        <div class="col">
          <label class="form-label">Telefone</label>
          <input
            type="tel"
            id="telefone"
            name="telefone"
            class="form-control"
            value="<?= $cliente['telefone'] ?? ''; ?>"
            placeholder="(99) 99999‑9999"
            required
          />
        </div>

        <div class="col">
          <label class="form-label">E‑mail</label>
          <input
            type="email"
            name="email"
            class="form-control"
            value="<?= $cliente['email'] ?? ''; ?>"
            placeholder="email@exemplo.com"
            required
          />
        </div>

        <div class="col">
          <label class="form-label">CPF</label>
          <input
            type="text"
            id="cpf"
            name="cpf"
            class="form-control"
            value="<?= $cliente['cpf'] ?? ''; ?>"
            placeholder="000.000.000‑00"
            required
          />
        </div>

        <div class="col">
          <label class="form-label">Data de nascimento</label>
          <input
            type="date"
            name="data_de_nascimento"
            class="form-control"
            value="<?= isset($cliente['data_de_nascimento']) ? date('Y-m-d', strtotime($cliente['data_de_nascimento'])) : ''; ?>"
            required
          />
        </div>

        <!-- Endereço -->
        <div class="col-12">
          <label class="form-label">Logradouro</label>
          <input
            type="text"
            name="logradouro"
            class="form-control"
            value="<?= $cliente['logradouro'] ?? ''; ?>"
            placeholder="Rua / Avenida"
            required
          />
        </div>

        <div class="col-md-3">
          <label class="form-label">Número</label>
          <input
            type="number"
            name="numero"
            class="form-control"
            value="<?= $cliente['numero'] ?? ''; ?>"
            required
          />
        </div>

        <div class="col-md-5">
          <label class="form-label">Bairro</label>
          <input
            type="text"
            name="bairro"
            class="form-control"
            value="<?= $cliente['bairro'] ?? ''; ?>"
            required
          />
        </div>

        <div class="col-md-4">
          <label class="form-label">Complemento</label>
          <input
            type="text"
            name="complemento"
            class="form-control"
            value="<?= $cliente['complemento'] ?? ''; ?>"
          />
        </div>

        <div class="col-md-4">
          <label class="form-label">CEP</label>
          <input
            type="text"
            id="cep"
            name="cep"
            class="form-control"
            value="<?= $cliente['cep'] ?? ''; ?>"
            placeholder="00000‑000"
            required
          />
        </div>

        <div class="col-md-5">
          <label class="form-label">Cidade</label>
          <input
            type="text"
            name="cidade"
            class="form-control"
            value="<?= $cliente['cidade'] ?? ''; ?>"
            required
          />
        </div>

        <div class="col-md-3">
          <label class="form-label">Estado</label>
          <input
            type="text"
            name="estado"
            class="form-control"
            value="<?= $cliente['estado'] ?? ''; ?>"
            maxlength="2"
            placeholder="UF"
            required
          />
        </div>

        <!-- Botões -->
        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>

          <a href="cliente.php" class="btn btn-secondary ms-1">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- IMask.js -->
<script src="https://unpkg.com/imask"></script>

<!-- Aplicação das máscaras -->
<script>
  // Telefone: aceita (00) 0000‑0000 ou (00) 00000‑0000
  IMask(document.getElementById('telefone'), {
    mask: [
      { mask: '(00) 0000-0000' },
      { mask: '(00) 00000-0000' }
    ]
  });

  // CPF
  IMask(document.getElementById('cpf'), {
    mask: '000.000.000-00'
  });

  // CEP
  IMask(document.getElementById('cep'), {
    mask: '00000-000'
  });
</script>

