<!-- view/formEstoque.php -->
<div class="container mt-4">
    <form method="get" class="row g-3 align-items-end">
        <div class="col-auto">
            <label for="qtdMinima" class="form-label mb-0">Máx. em estoque</label>
            <input
                type="number"
                name="quantidade"
                id="qtdMinima"
                class="form-control"
                min="1"
                value="<?= htmlspecialchars($_GET['quantidade'] ?? 5) ?>"
                placeholder="Ex.: 5"
                required
            >
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Listar
            </button>
        </div>
    </form>
</div>
