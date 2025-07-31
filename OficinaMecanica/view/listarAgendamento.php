<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Agendamentos</h2>
    <a href="agendamento.php?acao=novo" class="btn btn-dark">
      <i class="bi bi-plus-circle me-2"></i>Novo Agendamento
    </a>
  </div>

  <?php if (empty($agendamentos)) : ?>
    <div class="alert alert-info">Nenhum agendamento encontrado.</div>
  <?php else : ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Data</th>
            <th>Horário</th>
            <th>Status</th>
            <th>Cliente</th>
            <th>Veículo</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($agendamentos as $agendamento): ?>
            <tr>
              <td><?= htmlspecialchars(date('d/m/Y', strtotime($agendamento['data']))); ?></td>
              <td><?= htmlspecialchars(substr($agendamento['horario'], 0, 5)); ?></td>
              <td><?= htmlspecialchars(ucfirst($agendamento['status_agendamento'])); ?></td>
              <td><?= htmlspecialchars($agendamento['cliente']); ?></td>
              <td><?= htmlspecialchars($agendamento['veiculo']); ?></td>
              <td class="text-center">
                <a href="agendamento.php?acao=editar&id=<?= urlencode($agendamento['idagendamento']); ?>" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <!-- Botão para abrir o modal -->
                <button
                  class="btn btn-sm btn-outline-danger"
                  data-bs-toggle="modal"
                  data-bs-target="#modalConfirmarExclusao"
                  data-id="<?= $agendamento['idagendamento']; ?>"
                  data-info="<?= htmlspecialchars(date('d/m/Y', strtotime($agendamento['data'])) . ' às ' . substr($agendamento['horario'], 0, 5) . ' - ' . $agendamento['cliente']); ?>"
                  title="Excluir"
                >
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
        Tem certeza que deseja excluir o agendamento de <strong id="agendamentoInfo"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a id="btnExcluirAgendamento" href="#" class="btn btn-danger">Sim, excluir</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para preencher o modal com dados do agendamento -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('modalConfirmarExclusao');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const info = button.getAttribute('data-info');
    const id = button.getAttribute('data-id');

    // Atualiza a informação no modal
    const infoSpan = modal.querySelector('#agendamentoInfo');
    infoSpan.textContent = info;

    // Atualiza o link de exclusão
    const linkExcluir = modal.querySelector('#btnExcluirAgendamento');
    linkExcluir.href = `agendamento.php?acao=excluir&id=${id}`;
  });
});
</script>
