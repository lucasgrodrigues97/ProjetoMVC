<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManagerCreator = new EntityManagerCreator();
        $entityManager = $entityManagerCreator->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $cursos = $this->repositorioDeCursos->findAll();
        echo $this->renderizaHtml('cursos/listar-cursos.php', [
            //extract-> ex: cria uma variavel com o nome 'curso' e atribui o valor de $curso pra ela
            'cursos' => $cursos,
            'titulo' => 'Lista de cursos'
        ]);
    }
}