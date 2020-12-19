<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Controllers\Helper\MensagemTrait;
use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdicionarCursoController implements RequestHandlerInterface {

    use MensagemTrait;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);
        $descricao = filter_var($request->getParsedBody()['descricao'], FILTER_SANITIZE_STRING);

        $curso = new Curso();
        $curso->setDescricao($descricao);

        if (isset($id)) {
            $qb = $this->em->createQueryBuilder();
            $qb->update(Curso::class, 'c')
                    ->set('c.descricao', "?1")
                    ->where('c.id = ?2')
                    ->setParameter(1, $curso->getDescricao())
                    ->setParameter(2, $id)
                    ->getQuery()->execute();
            $this->exibirMensagem("success", "Curso atualizado com sucesso!");
        }
        else {
            $this->em->persist($curso);
            $this->exibirMensagem("success", "Curso adicionado com sucesso!");
        }

        $this->em->flush();

        return new Response(200, ["Location: /listar-cursos"]);
    }

}