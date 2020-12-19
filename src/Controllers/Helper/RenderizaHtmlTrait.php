<?php

namespace Alura\Cursos\Controllers\Helper;

trait RenderizaHtmlTrait {

    private function renderizaHtml(string $template, array $dados): string
    {
        extract($dados);
        ob_start();
        require_once __DIR__ . '/../../../views/' . $template;
        return ob_get_clean();   
    }


}