<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0">
        <?= isset($tipo_pagamento) ? 'Editar' : 'Cadastrar'; ?> Tipo de Pagamento
      </h3>
    </div>

    <div class="card-body">
      <form action="tipo_pagamento.php" method="post" class="row row-cols-1 row-cols-md-2 g-3">

        <!-- ação e id ocultos -->
        <input type="hidden" name="acao" value="<?= isset($tipo_pagamento) ? 'atualizar' : 'cadastrar'; ?>" />
        <?php if (isset($tipo_pagamento)) : ?>
          <input type="hidden" name="id" value="<?= $tipo_pagamento['idtipo_pagamento']; ?>" />
        <?php endif; ?>

        <div class="col-md-6">
          <label class="form-label">Nome</label>
          <input
            type="text"
            name="nome"
            class="form-control"
            value="<?= $tipo_pagamento['nome'] ?? ''; ?>"
            placeholder="Nome do método"
            required
          />
        </div>

        <div class="col-md-6">
          <label class="form-label">Número de Parcelas</label>
          <input
            type="number"
            name="nr_parcelas"
            class="form-control"
            value="<?= $tipo_pagamento['nr_parcelas'] ?? ''; ?>"
            placeholder="Ex: 1, 2, 3..."
            required
          />
        </div>

        <div class="col-md-6">
          <label class="form-label">Prazo da 1ª Parcela (dias)</label>
          <input
            type="number"
            name="prazo_primeira"
            class="form-control"
            value="<?= $tipo_pagamento['prazo_primeira'] ?? ''; ?>"
            placeholder="Ex: 30"
            required
          />
        </div>

        <div class="col-md-6">
          <label class="form-label">Intervalo entre Parcelas (dias)</label>
          <input
            type="number"
            name="intervalo"
            class="form-control"
            value="<?= $tipo_pagamento['intervalo'] ?? ''; ?>"
            placeholder="Ex: 30"
            required
          />
        </div>

        <div class="col-md-6">
          <label class="form-label">Juros (%)</label>
          <input
            type="text"
            name="juros"
            class="form-control"
            value="<?= $tipo_pagamento['juros'] ?? ''; ?>"
            placeholder="Ex: 2.5"
            required
          />
        </div>

        <!-- Botões -->
        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>

          <a href="tipo_pagamento.php" class="btn btn-secondary ms-1">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>

      </form>
    </div>
  </div>
</div>
