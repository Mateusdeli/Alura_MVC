<?php

use Alura\Cursos\Controllers\{
    AdicionarCursoController,
    EditarCursoController,
    ExcluirCursoController,
    FormLoginController,
    InserirCursoController,
    ListarCursosController,
    ListarCursosJson,
    ListarCursosXml,
    LoginController,
    LogoutController
};

return [
    "/listar-cursos" => ListarCursosController::class,
    "/formulario-novo-curso" => InserirCursoController::class,
    "/adicionar-curso" => AdicionarCursoController::class,
    '/excluir-curso' => ExcluirCursoController::class,
    '/editar-curso' => EditarCursoController::class,
    '/login' => FormLoginController::class,
    '/realiza-login' => LoginController::class,
    '/logout' => LogoutController::class,
    '/cursos-json' => ListarCursosJson::class,
    '/cursos-xml' => ListarCursosXml::class,
];

