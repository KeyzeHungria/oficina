<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Pagamentos</h2>
    <a href="pagamento.php?acao=novo" class="btn btn-dark">
      <i class="bi bi-cash-coin me-2"></i>Novo Pagamento
    </a>
  </div>

  <?php if (empty($pagamentos)) : ?>
    <div class="alert alert-info">Nenhum pagamento encontrado.</div>
  <?php else : ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Serviço</th>
            <th>Valor Parcela</th>
            <th>Data do Pagamento</th>
            <th>Status</th>
            <th>Valor Pago</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagamentos as $pagamento): ?>
            <tr>
              <td><?= htmlspecialchars($pagamento['tipo_servico']) ?></td>
              <td>R$ <?= number_format($pagamento['valor_parcela'], 2, ',', '.') ?></td>
              <td><?= date('d/m/Y', strtotime($pagamento['data_pagamento'])) ?></td>
              <td><?= htmlspecialchars($pagamento['status_pagamento']) ?></td>
              <td>R$ <?= number_format($pagamento['valor_pago'], 2, ',', '.') ?></td>
              <td class="text-center">
                <a href="pagamento.php?acao=editar&id=<?= $pagamento['idpagamento'] ?>" class="btn btn-sm btn-outline-primary me-1">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <!-- Botão para abrir o modal -->
                <button class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#modalConfirmarExclusao"
                        data-id="<?= $pagamento['idpagamento']; ?>"
                        data-servico="<?= htmlspecialchars($pagamento['tipo_servico']); ?>">
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
        Tem certeza que deseja excluir o pagamento referente ao serviço <strong id="pagamentoServico"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a id="btnExcluirPagamento" href="#" class="btn btn-danger">Sim, excluir</a>
      </div>
    </div>
  </div>
</div>

<!-- Script para preencher o modal com dados do pagamento -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('modalConfirmarExclusao');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const servico = button.getAttribute('data-servico');
    const id = button.getAttribute('data-id');

    // Atualiza o nome do serviço no modal
    modal.querySelector('#pagamentoServico').textContent = servico;

    // Atualiza o link de exclusão
    modal.querySelector('#btnExcluirPagamento').href = `pagamento.php?acao=excluir&id=${id}`;
  });
});
</script>
