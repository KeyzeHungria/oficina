<!-- Bootstrap CSS e Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0">Associar Funcionário ao Serviço</h3>
    </div>

    <div class="card-body">
      <form action="servico_funcionario.php" method="post" class="row g-3">
        <input type="hidden" name="acao" value="cadastrar" />

        <div class="col-md-6">
          <label for="idservico" class="form-label">Serviço</label>
          <select id="idservico" name="idservico" class="form-select" required>
            <option value="" disabled selected>Selecione...</option>
            <?php foreach ($servicos as $servico): ?>
              <option value="<?= $servico['idservico'] ?>"><?= htmlspecialchars($servico['tipo_servico']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6">
          <label for="idfuncionario" class="form-label">Funcionário</label>
          <select id="idfuncionario" name="idfuncionario" class="form-select" required>
            <option value="" disabled selected>Selecione...</option>
            <?php foreach ($funcionarios as $funcionario): ?>
              <option value="<?= $funcionario['idfuncionario'] ?>"><?= htmlspecialchars($funcionario['nome']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-save me-2"></i>Salvar
          </button>
          <a href="servico_funcionario.php" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
