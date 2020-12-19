<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SimpleXMLElement;

class ListarCursosXml implements RequestHandlerInterface
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->em->getRepository(Curso::class)->findAll();
        $cursosEmXml = new \SimpleXMLElement("<cursos/>");
        foreach ($cursos as $curso) {
            $cursosEmXml = $cursosEmXml->addChild("curso");
            $cursosEmXml->addChild("id", $curso->getId());
            $cursosEmXml->addChild("descricao", $curso->getDescricao());
        }

        return new Response(200, ['Content-Type' => 'application/xml'], $cursosEmXml->asXML());
    }

}