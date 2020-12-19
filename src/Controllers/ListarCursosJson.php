<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarCursosJson implements RequestHandlerInterface
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->em->getRepository(Curso::class)->findAll();
        return new Response(200, [], json_encode($cursos, JSON_PRETTY_PRINT));
    }

}