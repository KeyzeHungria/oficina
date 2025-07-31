<?php
$isEdit = isset($item) && $item != false;
$erroDuplicado = isset($_GET['erro']) && $_GET['erro'] === 'duplicado';
$selectedIdProduto = $_POST['idproduto'] ?? ($item['idproduto'] ?? '');
$selectedIdServico = $_POST['idservico'] ?? ($item['idservico'] ?? '');
?>

<!-- Bootstrap CSS e Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0"><?= $isEdit ? 'Editar Item de Serviço' : 'Cadastrar Item de Serviço'; ?></h3>
    </div>

    <div class="card-body">

      <?php if ($erroDuplicado): ?>
        <div class="alert alert-danger" role="alert">
          ❌ Este item de serviço (produto + serviço) já existe!
        </div>
      <?php endif; ?>

      <form action="item_servico.php" method="post" class="row row-cols-1 row-cols-md-2 g-3" oninput="calculaSubtotal()">
        <input type="hidden" name="acao" value="<?= $isEdit ? 'alterar' : 'cadastrar'; ?>" />

        <!-- Produto -->
        <div class="col">
          <label class="form-label">Produto</label>
          <select name="idproduto" class="form-select" required <?= $isEdit ? 'disabled' : '' ?>>
            <option value="">Selecione...</option>
            <?php foreach ($produtos as $produto): ?>
              <option value="<?= $produto['idproduto'] ?>" <?= ($selectedIdProduto == $produto['idproduto']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($produto['nome']) ?>
              </option>
            <?php endforeach; ?>
          </select>
          <?php if ($isEdit): ?>
            <input type="hidden" name="idproduto" value="<?= htmlspecialchars($item['idproduto']) ?>">
          <?php endif; ?>
        </div>

        <!-- Serviço -->
        <div class="col">
          <label class="form-label">Serviço</label>
          <select name="idservico" class="form-select" required <?= $isEdit ? 'disabled' : '' ?>>
            <option value="">Selecione...</option>
            <?php foreach ($servicos as $servico): ?>
              <option value="<?= $servico['idservico'] ?>" <?= ($selectedIdServico == $servico['idservico']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($servico['tipo_servico']) ?>
              </option>
            <?php endforeach; ?>
          </select>
          <?php if ($isEdit): ?>
            <input type="hidden" name="idservico" value="<?= htmlspecialchars($item['idservico']) ?>">
          <?php endif; ?>
        </div>

        <!-- Código do Item -->
        <div class="col">
          <label class="form-label">Código do Item</label>
          <input type="text" name="codigo_item" class="form-control" required
            value="<?= htmlspecialchars($_POST['codigo_item'] ?? ($item['codigo_item'] ?? '')) ?>" placeholder="Ex: P001-A" />
        </div>

        <!-- Quantidade -->
        <div class="col">
          <label class="form-label">Qtd. Peças Utilizadas</label>
          <input type="number" name="qtd_pecas_utilizadas" class="form-control" step="0.01" required
            value="<?= htmlspecialchars($_POST['qtd_pecas_utilizadas'] ?? (isset($item['qtd_pecas_utilizadas']) ? number_format($item['qtd_pecas_utilizadas'], 2, '.', '') : '')) ?>" />
        </div>

        <!-- Preço Unitário -->
        <div class="col">
          <label class="form-label">Preço Unitário (R$)</label>
          <input type="number" name="preco_unitario" class="form-control" step="0.01" required
            value="<?= htmlspecialchars($_POST['preco_unitario'] ?? (isset($item['preco_unitario']) ? number_format($item['preco_unitario'], 2, '.', '') : '')) ?>" />
        </div>

        <!-- Subtotal -->
        <div class="col">
          <label class="form-label">Subtotal (R$)</label>
          <input type="text" name="subtotal" id="subtotal" class="form-control" readonly
            value="<?= htmlspecialchars($_POST['subtotal'] ?? (isset($item['subtotal']) ? number_format($item['subtotal'], 2, '.', '') : '0.00')) ?>" />
        </div>

        <!-- Botões -->
        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>
          <a href="item_servico.php" class="btn btn-secondary ms-1">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Cálculo automático do subtotal -->
<script>
  function calculaSubtotal() {
    const qtd = parseFloat(document.querySelector('[name="qtd_pecas_utilizadas"]').value) || 0;
    const preco = parseFloat(document.querySelector('[name="preco_unitario"]').value) || 0;
    document.getElementById('subtotal').value = (qtd * preco).toFixed(2);
  }
  window.addEventListener('DOMContentLoaded', calculaSubtotal);
</script>


