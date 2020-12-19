<?php require_once __DIR__ . '/../inicio-html.php'; ?>

<form action="/realiza-login" method="POST">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" id="email" />
    </div>
    <div class="form-group">
        <label for="senha">Password:</label>
        <input type="password" name="senha" class="form-control" id="senha" />
    </div>
    <button class="btn btn-primary">Entrar</button>
</form>

<?php require_once __DIR__ . '/../fim-html.php'; ?>