<?php
session_start();
$usuarioTipoLogado = $_SESSION["usuario_tipo"] ?? 'usuario';
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Usuários</h2>
    <?php if ($usuarioTipoLogado === 'admin'): ?>
      <a href="usuario.php?acao=novo" class="btn btn-dark">
        <i class="bi bi-person-plus me-2"></i>Novo Usuário
      </a>
    <?php endif; ?>
  </div>

  <?php if (empty($usuarios)) : ?>
    <div class="alert alert-info">Nenhum usuário encontrado.</div>
  <?php else : ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Nome</th>
            <th>E‑mail</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $usuario): ?>
            <tr>
              <td><?= htmlspecialchars($usuario['nome']); ?></td>
              <td><?= htmlspecialchars($usuario['email']); ?></td>
              <td class="text-center">
                <a href="usuario.php?acao=editar&id=<?= $usuario['idusuario']; ?>" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <?php if ($usuarioTipoLogado === 'admin'): ?>
                  <button class="btn btn-sm btn-outline-danger"
                          data-bs-toggle="modal"
                          data-bs-target="#modalConfirmarExclusao"
                          data-id="<?= $usuario['idusuario']; ?>"
                          data-nome="<?= htmlspecialchars($usuario['nome']); ?>"
                          title="Excluir">
                    <i class="bi bi-trash"></i>
                  </button>
                <?php endif; ?>
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
        Tem certeza que deseja excluir o usuário <strong id="usuarioNome"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a id="btnExcluirUsuario" href="#" class="btn btn-danger">Sim, excluir</a>
      </div>
    </div>
  </div>
</div>

<!-- Script para preencher o modal com dados do usuário -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('modalConfirmarExclusao');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const nome = button.getAttribute('data-nome');
    const id = button.getAttribute('data-id');

    modal.querySelector('#usuarioNome').textContent = nome;
    modal.querySelector('#btnExcluirUsuario').href = `usuario.php?acao=excluir&id=${id}`;
  });
});
</script>


