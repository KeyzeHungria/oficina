<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Itens de Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="p-3">
<div class="container">
    <h1>Itens de Serviço</h1>
    <a href="item_servico.php?acao=novo" class="btn btn-primary mb-3">Novo Item Serviço</a>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Serviço</th>
                <th>Código Item</th>
                <th>Qtd. Peças Utilizadas</th>
                <th>Preço Unitário (R$)</th>
                <th>Subtotal (R$)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($itens) > 0): ?>
                <?php foreach($itens as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['produtos']) ?></td>
                        <td><?= htmlspecialchars($item['tipo_servico']) ?></td>
                        <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                        <td><?= number_format($item['qtd_pecas_utilizadas'], 2, ',', '.') ?></td>
                        <td><?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
                        <td><?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                        <td>
                            <a href="item_servico.php?acao=editar&idproduto=<?= $item['idproduto'] ?>&idservico=<?= $item['idservico'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="item_servico.php?acao=excluir&idproduto=<?= $item['idproduto'] ?>&idservico=<?= $item['idservico'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma exclusão?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">Nenhum item de serviço cadastrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

