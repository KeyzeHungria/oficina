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
        <?= isset($servico) ? 'Editar' : 'Cadastrar'; ?> Serviço
      </h3>
    </div>

    <div class="card-body">
      <form action="servico.php" method="post" class="row g-3">
        <input
          type="hidden"
          name="acao"
          value="<?= isset($servico) ? 'atualizar' : 'cadastrar' ?>"
        />
        <?php if (isset($servico)) : ?>
          <input
            type="hidden"
            name="id"
            value="<?= htmlspecialchars($servico["idservico"]) ?>"
          />
        <?php endif; ?>

        <div class="col-12">
          <label class="form-label">Tipo de Serviço</label>
          <input
            type="text"
            name="tipo_servico"
            class="form-control"
            value="<?= htmlspecialchars($servico['tipo_servico'] ?? '') ?>"
            required
          />
        </div>

        <div class="col-12">
          <label class="form-label">Descrição</label>
          <textarea
            name="descricao"
            rows="3"
            class="form-control"
          ><?= htmlspecialchars($servico['descricao'] ?? '') ?></textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Agendamento</label>
          <select
            name="idagendamento"
            class="form-select"
            required
          >
            <option value="">-- Selecione um agendamento --</option>
            <?php if (!empty($agendamentos)): ?>
              <?php foreach ($agendamentos as $agendamento): ?>
                <option
                  value="<?= htmlspecialchars($agendamento['idagendamento']) ?>"
                  <?= (isset($servico) && ($servico['idagendamento'] ?? '') == $agendamento['idagendamento']) ? 'selected' : '' ?>
                >
                  <?= htmlspecialchars(
                       ($agendamento['data'] ?? '') . ' - ' . 
                       ($agendamento['horario'] ?? '') . ' - ' . 
                       ($agendamento['cliente'] ?? '') . ' - ' . 
                       ($agendamento['veiculo'] ?? '')
                     ) ?>
                </option>
              <?php endforeach; ?>
            <?php else: ?>
              <option disabled>Nenhum agendamento disponível</option>
            <?php endif; ?>
          </select>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Status</label>
          <select
            name="status_servico"
            class="form-select"
            required
          >
            <?php
              $status = ['pendente', 'em andamento', 'concluído'];
              foreach ($status as $s):
            ?>
              <option
                value="<?= htmlspecialchars($s) ?>"
                <?= (isset($servico) && ($servico['status_servico'] ?? '') == $s) ? 'selected' : '' ?>
              >
                <?= ucfirst($s) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <?php if (isset($servico)): ?>
          <div class="col-12 col-md-6">
            <label class="form-label">Tipo de Pagamento</label>
            <select name="idtipo_pagamento" class="form-select">
              <option value="">-- Selecione um tipo de pagamento --</option>
              <?php foreach ($tipos_pagamento as $pagamento): ?>
                <option
                  value="<?= htmlspecialchars($pagamento['idtipo_pagamento']) ?>"
                  <?= ($servico['idtipo_pagamento'] ?? '') == $pagamento['idtipo_pagamento'] ? 'selected' : '' ?>
                >
                  <?= htmlspecialchars($pagamento['nome']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php endif; ?>

        <div class="col-12 col-md-6">
          <label class="form-label">Mão de Obra</label>
          <input
            type="number"
            name="mao_obra"
            step="0.01"
            min="0"
            class="form-control"
            value="<?= htmlspecialchars($servico['mao_obra'] ?? '0.00') ?>"
            required
          />
        </div>

        <?php if (isset($servico)): ?>
          <div class="col-12 col-md-6">
            <label class="form-label">Valor Total</label>
            <input
              type="number"
              name="valor_total"
              step="0.01"
              class="form-control"
              value="<?= htmlspecialchars($servico['valor_total'] ?? '') ?>"
              readonly
            />
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Pagamentos Gerados</label><br>
            <?php if (!empty($servico['pagamento_gerado'])): ?>
              <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i>Sim</span>
            <?php else: ?>
              <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle-fill me-1"></i>Não</span>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>

          <a href="servico.php" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>


