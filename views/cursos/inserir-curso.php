<?php require_once __DIR__ . '/../inicio-html.php'; ?>
<form action="/adicionar-curso<?= isset($curso) ? '?id='.$curso->getId() : '' ?>" method="post">
    <div class="form-group">
        <label for="descricao">Descricao:</label>
        <input type="text" name="descricao" class="form-control" id="descricao"
            value="<?= isset($curso) ? $curso->getDescricao() : '' ?>">
    </div>
    <button class="btn btn-primary">Cadastrar</button>
</form>
<?php require_once __DIR__ . '/../fim-html.php'; ?>