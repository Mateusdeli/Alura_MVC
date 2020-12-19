<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Controllers\Helper\RenderizaHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class InserirCursoController implements RequestHandlerInterface {

    use RenderizaHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $titulo = "Novo Curso";
        return new Response(200, [], $this->renderizaHtml('cursos/inserir-curso.php', [
            "titulo" => $titulo
        ]));
    }

}