<!-- view/listarEstoque.php -->
<?php if (!empty($produtos)): ?>          <!-- <‑‑ troque iten​s por produt​os -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Produto</th>
                    <th>Qtd. em estoque</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p): ?>   <!-- idem aqui -->
                    <tr>
                        <td><?= htmlspecialchars($p['nome']); ?></td>
                        <td><?= htmlspecialchars($p['quantidade']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info">Nenhum produto com estoque baixo.</div>
<?php endif; ?>

