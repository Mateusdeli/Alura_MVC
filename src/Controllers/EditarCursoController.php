<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Controllers\Helper\MensagemTrait;
use Alura\Cursos\Controllers\Helper\RenderizaHtmlTrait;
use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditarCursoController implements RequestHandlerInterface {

    use MensagemTrait;
    use RenderizaHtmlTrait;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);

        if (is_null($id) || $id === false) {
            $this->exibirMensagem("danger", "Curso não encontrado!");
            return new Response(404, ["Location: /listar-cursos"]);
        }

        $curso = $this->em->find(Curso::class, $id);
        $titulo = "Alterar curso: " . $curso->getDescricao();

        return new Response(200, [], $this->renderizaHtml('cursos/inserir-curso.php', [
            "curso" => $curso,
            "titulo" => $titulo
        ]));

    }

}