<?php

namespace Alura\Cursos\Controllers\Helper;

trait MensagemTrait {

    private function exibirMensagem(string $tipo_mensagem, string $mensagem): void
    {
        $_SESSION['tipo_mensagem'] = $tipo_mensagem;
        $_SESSION['mensagem'] = $mensagem;
    }

}