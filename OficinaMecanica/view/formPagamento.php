<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0"><?= isset($pagamento) ? 'Editar Pagamento' : 'Cadastrar Pagamento'; ?></h3>
    </div>

    <div class="card-body">
      <form action="pagamento.php" method="post" class="row row-cols-1 row-cols-md-2 g-3">
        <input type="hidden" name="acao" value="<?= isset($pagamento) ? 'atualizar' : 'cadastrar'; ?>" />
        <?php if (isset($pagamento)) : ?>
          <input type="hidden" name="id" value="<?= $pagamento["idpagamento"]; ?>" />
        <?php endif; ?>

        <div class="col-md-6">
          <label for="idservico" class="form-label">Serviço</label>
          <select name="idservico" id="idservico" class="form-select" required>
            <option value="">-- Selecione o serviço --</option>
            <?php foreach ($servicos as $servico): ?>
              <option value="<?= $servico['idservico'] ?>"
                <?= (isset($pagamento) && $pagamento["idservico"] == $servico["idservico"]) ? 'selected' : '' ?>>
                <?= htmlspecialchars($servico['tipo_servico']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6">
          <label for="valor_parcela" class="form-label">Valor da Parcela</label>
          <input type="number" step="0.01" min="0" name="valor_parcela" id="valor_parcela" class="form-control"
            value="<?= $pagamento['valor_parcela'] ?? ''; ?>" required />
        </div>

        <div class="col-md-6">
          <label for="data_pagamento" class="form-label">Data do Pagamento</label>
          <input type="date" name="data_pagamento" id="data_pagamento" class="form-control"
            value="<?= $pagamento['data_pagamento'] ?? ''; ?>" required />
        </div>

        <div class="col-md-6">
          <label for="status_pagamento" class="form-label">Status do Pagamento</label>
          <select name="status_pagamento" id="status_pagamento" class="form-select" required>
            <option value="">-- Selecione o status --</option>
            <?php
              $statusOptions = ['Pendente', 'Pago', 'Atrasado', 'Cancelado'];
              foreach ($statusOptions as $status):
            ?>
              <option value="<?= $status ?>" <?= (isset($pagamento) && $pagamento['status_pagamento'] == $status) ? 'selected' : '' ?>>
                <?= $status ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6">
          <label for="valor_pago" class="form-label">Valor Pago</label>
          <input type="number" step="0.01" min="0" name="valor_pago" id="valor_pago" class="form-control"
            value="<?= $pagamento['valor_pago'] ?? ''; ?>" required />
        </div>

        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>
          <a href="pagamento.php" class="btn btn-secondary ms-1">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

