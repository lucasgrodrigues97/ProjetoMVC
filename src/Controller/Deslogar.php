<?php

namespace Alura\Cursos\Controller;

class Deslogar extends ControllerComHtml implements InterfaceControladorRequisicao
{

    public function processaRequisicao(): void
    {
        session_destroy();
        header('Location: /login');
    }
}