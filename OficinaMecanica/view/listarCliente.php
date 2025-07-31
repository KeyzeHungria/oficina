<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Clientes</h2>
    <a href="cliente.php?acao=novo" class="btn btn-dark">
      <i class="bi bi-person-plus me-2"></i>Novo Cliente
    </a>
  </div>

  <?php if (empty($clientes)) : ?>
    <div class="alert alert-info">Nenhum cliente encontrado.</div>
  <?php else : ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E‑mail</th>
            <th>CPF</th>
            <th>Data de Nascimento</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($clientes as $cliente): ?>
            <tr>
              <td><?= $cliente['nome']; ?></td>
              <td><?= $cliente['telefone']; ?></td>
              <td><?= $cliente['email']; ?></td>
              <td><?= $cliente['cpf']; ?></td>
              <td><?= date('d/m/Y', strtotime($cliente['data_de_nascimento'])); ?></td>
              <td class="text-center">
                <a href="cliente.php?acao=editar&id=<?= $cliente['idcliente']; ?>" class="btn btn-sm btn-outline-primary me-1">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <!-- Botão para abrir o modal -->
                <button class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#modalConfirmarExclusao"
                        data-id="<?= $cliente['idcliente']; ?>"
                        data-nome="<?= htmlspecialchars($cliente['nome']); ?>">
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
        Tem certeza que deseja excluir o cliente <strong id="clienteNome"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a id="btnExcluirCliente" href="#" class="btn btn-danger">Sim, excluir</a>
      </div>
    </div>
  </div>
</div>

<!-- Script para preencher o modal com dados do cliente -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('modalConfirmarExclusao');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const nome = button.getAttribute('data-nome');
    const id = button.getAttribute('data-id');

    // Atualiza o nome no texto do modal
    const nomeSpan = modal.querySelector('#clienteNome');
    nomeSpan.textContent = nome;

    // Atualiza o link de exclusão
    const linkExcluir = modal.querySelector('#btnExcluirCliente');
    linkExcluir.href = `cliente.php?acao=excluir&id=${id}`;
  });
});
</script>
