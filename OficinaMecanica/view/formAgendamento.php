<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0">
        <?= isset($agendamento) ? 'Editar Agendamento' : 'Cadastrar Agendamento' ?>
      </h3>
    </div>

    <div class="card-body">
      <?php if (isset($_GET['erro'])): ?>
        <?php
          $mensagens = [
            'conflito' => 'Já existe um agendamento para este horário com este veículo ou cliente.',
            'intervalo_conflito' => 'Deve haver pelo menos 1 hora de intervalo entre os agendamentos para o mesmo cliente ou veículo.',
            'domingo' => 'Não é possível agendar aos domingos.',
            'sabado_manha' => 'Sábados só permitem agendamento entre 09:00 e 12:00.',
            'fora_horario' => 'Horário fora do horário comercial (09:00 às 17:00).',
            'limite_horario' => 'Limite de 3 agendamentos por horário atingido.'
          ];
        ?>
        <?php if (array_key_exists($_GET['erro'], $mensagens)): ?>
          <div class="alert alert-danger" role="alert">
            <?= $mensagens[$_GET['erro']] ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <form action="agendamento.php" method="post" class="row g-3">
        <input type="hidden" name="acao" value="<?= isset($agendamento) ? 'atualizar' : 'cadastrar' ?>">
        <?php if (isset($agendamento)) : ?>
          <input type="hidden" name="id" value="<?= $agendamento['idagendamento'] ?>">
        <?php endif; ?>

        <div class="col-md-6">
          <label class="form-label">Data</label>
          <input type="date" name="data" class="form-control" value="<?= $agendamento['data'] ?? '' ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Horário</label>
          <input type="time" name="horario" class="form-control" value="<?= $agendamento['horario'] ?? '' ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Veículo</label>
          <select name="idveiculo" class="form-select" required>
            <?php foreach ($veiculos as $veiculo): ?>
              <option value="<?= $veiculo['idveiculo'] ?>" <?= (isset($agendamento) && $agendamento['idveiculo'] == $veiculo['idveiculo']) ? 'selected' : '' ?>>
                <?= $veiculo['placa'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Cliente</label>
          <select name="idcliente" class="form-select" required>
            <?php foreach ($clientes as $cliente): ?>
              <option value="<?= $cliente['idcliente'] ?>" <?= (isset($agendamento) && $agendamento['idcliente'] == $cliente['idcliente']) ? 'selected' : '' ?>>
                <?= $cliente['nome'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Status</label>
          <select name="status_agendamento" class="form-select" required>
            <?php
              $statusOpcoes = ["agendado", "concluído", "cancelado", "anulado"];
              $statusAtual = isset($agendamento) ? $agendamento["status_agendamento"] : "agendado";
              foreach ($statusOpcoes as $status) {
                $selected = ($statusAtual == $status) ? "selected" : "";
                echo "<option value='$status' $selected>$status</option>";
              }
            ?>
          </select>
        </div>

        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>
          <a href="index.php" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS (opcional, mas recomendado para melhor suporte aos componentes) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
