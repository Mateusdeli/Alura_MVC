<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Controllers\Helper\RenderizaHtmlTrait;
use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListarCursosController implements RequestHandlerInterface {

    use RenderizaHtmlTrait;

    private $repositorioDeCursos;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repositorioDeCursos = $this->em->getRepository(Curso::class);
    }
    
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos = $this->repositorioDeCursos->findAll();
        $titulo = "Lista de Cursos";
        return new Response(200, [], $this->renderizaHtml('/cursos/listar-cursos.php', [
            "cursos" => $cursos,
            "titulo" => $titulo
        ]));
    }

}