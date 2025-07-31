<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Serviços</h2>
    <a href="servico.php?acao=novo" class="btn btn-dark">
      <i class="bi bi-plus-circle me-2"></i>Novo Serviço
    </a>
  </div>

  <?php if (empty($servicos)) : ?>
    <div class="alert alert-info">Nenhum serviço encontrado.</div>
  <?php else : ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Status</th>
            <th>Valor Total</th>
            <th>Pagamentos</th> <!-- NOVA COLUNA -->
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($servicos as $servico): ?>
            <tr>
              <td><?= htmlspecialchars($servico['tipo_servico']); ?></td>
              <td><?= htmlspecialchars($servico['descricao']); ?></td>
              <td><?= htmlspecialchars($servico['nome_cliente']); ?></td>
              <td><?= htmlspecialchars($servico['placa_veiculo']); ?></td>
              <td><?= ucfirst($servico['status_servico']); ?></td>
              <td>R$ <?= number_format($servico['valor_total'], 2, ',', '.'); ?></td>
              
              <td>
                <?php if (!empty($servico['pagamento_gerado'])): ?>
                  <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Gerado</span>
                <?php else: ?>
                  <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle me-1"></i>Pendente</span>
                <?php endif; ?>
              </td>

              <td class="text-center">
                <a href="servico.php?acao=editar&id=<?= $servico['idservico']; ?>" class="btn btn-sm btn-outline-primary me-1">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <a href="servico.php?acao=excluir&id=<?= $servico['idservico']; ?>"
                   class="btn btn-sm btn-outline-danger"
                   onclick="return confirm('Tem certeza que deseja excluir este serviço?');">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
