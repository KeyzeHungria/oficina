

<h1>Associações Serviço x Funcionário</h1>

<?php if (isset($_SESSION['msg'])): ?>
    <div class="alert alert-warning"><?= $_SESSION['msg'] ?></div>
    <?php unset($_SESSION['msg']); ?>
<?php endif; ?>

<a href="servico_funcionario.php?acao=novo" class="btn btn-primary mb-3">Nova Associação</a>

<?php if (!empty($servico_funcionario)): ?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Serviço</th>
            <th>Funcionário</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($servico_funcionario as $sf): ?>
            <tr>
                <td><?= htmlspecialchars($sf['tipo_servico']) ?></td>
                <td><?= htmlspecialchars($sf['nome']) ?></td>
                <td>
                    <a href="servico_funcionario.php?acao=excluir&idservico=<?= $sf['idservico'] ?>&idfuncionario=<?= $sf['idfuncionario'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Tem certeza que deseja excluir esta associação?')">
                       Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p class="alert alert-info">Nenhuma associação encontrada.</p>
<?php endif; ?>
