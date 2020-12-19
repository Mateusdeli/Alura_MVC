<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Controllers\Helper\MensagemTrait;
use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExcluirCursoController implements RequestHandlerInterface {

    use MensagemTrait;

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
            return new Response(404, ['Location: /listar-cursos']);
        }

        $curso = $this->em->find(Curso::class, $id);

        $this->em->remove($curso);
        $this->em->flush();
        $this->exibirMensagem("success", "Curso removido com sucesso!");
        return new Response(200, ["Location: /listar-cursos"]);
    }

}