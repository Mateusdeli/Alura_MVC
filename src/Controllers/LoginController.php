<?php

namespace Alura\Cursos\Controllers;

use Alura\Cursos\Controllers\Helper\MensagemTrait;
use Alura\Cursos\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginController implements RequestHandlerInterface {

    use MensagemTrait;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface 
    {

        $email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_STRING);
        $senha = filter_var($request->getParsedBody()['senha'], FILTER_SANITIZE_STRING);

        if (is_null($email) || $email === false) {
            
            $this->exibirMensagem("danger", "Email fornecido é inválido!");
            header('Location: /login');
            die();
        }

        if (is_null($senha) || $senha === false) {
            $this->exibirMensagem("danger", "Senha fornecida é inválida!");
            header('Location: /login');
            die();
        }

        $usuario = $this->em->getRepository(Usuario::class)->findOneBy(['email' => $email]);

        if (is_null($usuario)) {
            $this->exibirMensagem("danger", "Usuario não encontrado!");
            header('Location: /login');
            die();
        }

        if ($usuario->senhaEstaCorreta($senha)) {
            $_SESSION['logado'] = true;
            return new Response(200, ['Location: /listar-cursos'], "");
        }
        else {
            header('Location: /login');
        }
        
    }

}