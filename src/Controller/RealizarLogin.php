<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin extends ControllerComHtml implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;
    private $repositorioDeUsuarios;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if($email === false || is_null($email)) {
            $this->defineMenssagem('danger', 'E-mail inválido');
            header('Location: /login');
            return;
        }

        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        /** @var Usuario $usuario */
        $usuario = $this->repositorioDeUsuarios->findOneBy(['email' => $email]);
        if (is_null($usuario) || ! $usuario->senhaEstaCorreta($senha)) {
            $this->defineMenssagem('danger', 'E-mail ou senha inválidos');
            header('Location: /login');
            return;
        }


        $_SESSION['logado'] = true;


        header('Location: /listar-cursos');

    }
}