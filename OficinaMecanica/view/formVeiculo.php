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

  <?php
  // Exibir mensagens de alerta, caso existam na URL
  if (isset($_GET['mensagem']) && isset($_GET['tipo'])):
    $tipos_validos = ['success', 'danger', 'warning', 'info', 'primary', 'secondary', 'light', 'dark'];
    $tipo = in_array($_GET['tipo'], $tipos_validos) ? $_GET['tipo'] : 'info';
    $mensagem = htmlspecialchars($_GET['mensagem']);
    $icones = [
      'success' => 'bi-check-circle-fill',
      'danger' => 'bi-x-circle-fill',
      'warning' => 'bi-exclamation-triangle-fill',
      'info' => 'bi-info-circle-fill',
      'primary' => 'bi-info-circle-fill',
      'secondary' => 'bi-info-circle-fill',
      'light' => 'bi-info-circle-fill',
      'dark' => 'bi-info-circle-fill'
    ];
    $icone = $icones[$tipo];
  ?>
    <div class="alert alert-<?= $tipo ?> alert-dismissible fade show d-flex align-items-center" role="alert">
      <i class="bi <?= $icone ?> me-2 fs-4"></i>
      <div><?= $mensagem ?></div>
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0"><?= isset($veiculo) ? 'Editar' : 'Cadastrar'; ?></h3>
    </div>

    <div class="card-body">
      <form
        action="veiculo.php"
        method="post"
        class="row row-cols-1 row-cols-md-2 g-3"
      >
        <!-- ação e id (ocultos) -->
        <input
          type="hidden"
          name="acao"
          value="<?= isset($veiculo) ? 'atualizar' : 'cadastrar'; ?>"
        />
        <?php if (isset($veiculo)) : ?>
          <input
            type="hidden"
            name="id"
            value="<?= $veiculo['idveiculo']; ?>"
          />
        <?php endif; ?>

        <div class="col">
          <label class="form-label">Modelo</label>
          <input
            type="text"
            name="modelo"
            class="form-control"
            value="<?= $veiculo['modelo'] ?? ''; ?>"
            placeholder="Digite o modelo"
            required
          />
        </div>

        <div class="col">
          <label class="form-label">Ano</label>
          <input
            type="number"
            name="ano"
            class="form-control"
            value="<?= $veiculo['ano'] ?? ''; ?>"
            placeholder="Digite o ano"
            required
            min="1900"
            max="<?= date('Y') + 1 ?>"
          />
        </div>

        <div class="col">
          <label class="form-label">Placa</label>
          <input
            type="text"
            id="placa"
            name="placa"
            class="form-control"
            value="<?= $veiculo['placa'] ?? ''; ?>"
            placeholder="AAA-0000 ou AAA-0A00"
            required
          />
        </div>

        <div class="col">
          <label class="form-label">Chassi</label>
          <input
            type="text"
            name="chassi"
            class="form-control"
            value="<?= $veiculo['chassi'] ?? ''; ?>"
            placeholder="Digite o chassi"
            required
          />
        </div>

        <div class="col">
          <label class="form-label">Marca</label>
          <input
            type="text"
            name="marca"
            class="form-control"
            value="<?= $veiculo['marca'] ?? ''; ?>"
            placeholder="Digite a marca"
            required
          />
        </div>

       <div class="col">
          <label class="form-label">Cliente</label>
          <select
            name="idcliente"
            class="form-select"
            required
          >
            <option value="">Selecione um cliente</option>
            <?php foreach ($clientes as $cliente): ?>
              <option
                value="<?= $cliente['idcliente']; ?>"
                <?= (isset($veiculo['idcliente']) && $veiculo['idcliente'] == $cliente['idcliente']) ? 'selected' : ''; ?>
              >
                <?= htmlspecialchars($cliente['nome']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Botões -->
        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>

          <a href="veiculo.php" class="btn btn-secondary ms-1">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- IMask.js -->
<script src="https://unpkg.com/imask"></script>

<script>
  IMask(document.getElementById('placa'), {
    mask: [
      {
        mask: 'AAA-0000',
        definitions: {
          'A': /[A-Za-z]/
        },
        prepare: function(str) {
          return str.toUpperCase();
        }
      },
      {
        mask: 'AAA-0A00',
        definitions: {
          'A': /[A-Za-z]/
        },
        prepare: function(str) {
          return str.toUpperCase();
        }
      }
    ],
    dispatch: function(appended, dynamicMasked) {
      const value = (dynamicMasked.value + appended).toUpperCase().replace(/-/g, '');
      if (value.length > 4 && /[A-Z]{3}[0-9][A-Z]/.test(value.substr(0,5))) {
        return dynamicMasked.compiledMasks[1];
      }
      return dynamicMasked.compiledMasks[0];
    }
  });
</script>
