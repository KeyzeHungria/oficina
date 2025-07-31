<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container py-5">
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h3 class="mb-0"><?= isset($produto) ? 'Editar Produto' : 'Cadastrar Produto'; ?></h3>
    </div>
    <div class="card-body">
      <form action="produto.php" method="post" class="row row-cols-1 row-cols-md-2 g-3">
        <input type="hidden" name="acao" value="<?= isset($produto) ? 'atualizar' : 'cadastrar'; ?>" />
        <?php if (isset($produto)) : ?>
          <input type="hidden" name="id" value="<?= $produto['idproduto']; ?>" />
        <?php endif; ?>

        <!-- Campos do formulário -->
        <div class="col">
          <label class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" required value="<?= $produto['nome'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Quantidade</label>
          <input type="number" name="quantidade" class="form-control" required value="<?= $produto['quantidade'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Data de Entrada</label>
          <input type="date" name="data_entrada" class="form-control" value="<?= $produto['data_entrada'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Data de Saída</label>
          <input type="date" name="data_saida" class="form-control" value="<?= $produto['data_saida'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Modelo</label>
          <input type="text" name="modelo" class="form-control" value="<?= $produto['modelo'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Marca</label>
          <input type="text" name="marca" class="form-control" value="<?= $produto['marca'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Ano</label>
          <input type="text" name="ano" class="form-control" value="<?= $produto['ano'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Preço</label>
          <input type="text" name="preco" class="form-control" value="<?= $produto['preco'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Lote</label>
          <input type="number" name="lote" class="form-control" value="<?= $produto['lote'] ?? '' ?>" />
        </div>

        <div class="col">
          <label class="form-label">Data de Vencimento</label>
          <input type="date" name="data_vencimento" class="form-control" value="<?= $produto['data_vencimento'] ?? '' ?>" />
        </div>

        <!-- Botões -->
        <div class="col-12 pt-3">
          <button type="submit" class="btn btn-dark">
            <i class="bi bi-save me-2"></i>Salvar
          </button>

          <a href="produto.php" class="btn btn-secondary ms-1">
            <i class="bi bi-arrow-left-circle me-2"></i>Voltar
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
