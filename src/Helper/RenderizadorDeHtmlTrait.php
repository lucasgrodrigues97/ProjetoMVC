<?php

namespace Alura\Cursos\Helper;

trait RenderizadorDeHtmlTrait
{
    public function renderizaHtml(string $caminhoTemplate, array $dados): string
    {
        //['curso' => $curso] -> FormularioEdicao.php
        //extract-> ex: cria uma variavel através de um array associativo com o nome 'curso' e atribui o valor de $curso pra ela
        extract($dados);
        ob_start();
        require __DIR__ . '/../../view/' . $caminhoTemplate;

        //pega o conteudo que vai ser exibido
        $html = ob_get_clean();
        return $html;
    }
}