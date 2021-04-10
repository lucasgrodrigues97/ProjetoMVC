<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/formulario.php', [
            //extract-> ex: cria uma variavel com o nome 'titulo' e atribui o valor de 'Novo curso' pra ela
            'titulo' => 'Novo curso'
        ]);
    }
}