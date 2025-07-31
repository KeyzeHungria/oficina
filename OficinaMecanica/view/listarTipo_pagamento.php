<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Tipos de Pagamento</h2>
    <a href="tipo_pagamento.php?acao=novo" class="btn btn-dark">
      <i class="bi bi-plus-circle me-2"></i>Novo Tipo
    </a>
  </div>

  <?php if (empty($tipo_pagamentos)) : ?>
    <div class="alert alert-info">Nenhum tipo de pagamento encontrado.</div>
  <?php else : ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Nome</th>
            <th>Parcelas</th>
            <th>Prazo 1ª Parcela (dias)</th>
            <th>Intervalo (dias)</th>
            <th>Juros (%)</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tipo_pagamentos as $tipo_pagamento): ?>
            <tr>
              <td><?= htmlspecialchars($tipo_pagamento['nome']); ?></td>
              <td><?= $tipo_pagamento['nr_parcelas']; ?></td>
              <td><?= $tipo_pagamento['prazo_primeira']; ?></td>
              <td><?= $tipo_pagamento['intervalo']; ?></td>
              <td><?= $tipo_pagamento['juros']; ?></td>
              <td class="text-center">
                <a href="tipo_pagamento.php?acao=editar&id=<?= $tipo_pagamento['idtipo_pagamento']; ?>" class="btn btn-sm btn-outline-primary me-1">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <button class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#modalConfirmarExclusao"
                        data-id="<?= $tipo_pagamento['idtipo_pagamento']; ?>"
                        data-nome="<?= htmlspecialchars($tipo_pagamento['nome']); ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" aria-labelledby="modalConfirmarExclusaoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning-subtle">
        <h5 class="modal-title" id="modalConfirmarExclusaoLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir o tipo de pagamento <strong id="tipoNome"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a id="btnExcluirTipo" href="#" class="btn btn-danger">Sim, excluir</a>
      </div>
    </div>
  </div>
</div>

<!-- Script para preencher o modal com dados do tipo de pagamento -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('modalConfirmarExclusao');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const nome = button.getAttribute('data-nome');
    const id = button.getAttribute('data-id');

    // Atualiza o nome no modal
    modal.querySelector('#tipoNome').textContent = nome;

    // Atualiza o link de exclusão
    modal.querySelector('#btnExcluirTipo').href = `tipo_pagamento.php?acao=excluir&id=${id}`;
  });
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
