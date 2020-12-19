<?php require_once __DIR__ . '/../inicio-html.php'; ?>
    <a href="/formulario-novo-curso" class="btn btn-primary mb-3">Adicionar</a>
    <ul class="list-group">
        <?php foreach ($cursos as $curso): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $curso->getDescricao(); ?>
                <span>
                    <a href="/editar-curso?id=<?= $curso->getId() ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="/excluir-curso?id=<?= $curso->getId() ?>" class="btn btn-danger btn-sm">Excluir</a>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php require_once __DIR__ . '/../fim-html.php'; ?>