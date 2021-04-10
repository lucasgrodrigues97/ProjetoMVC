<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao implements InterfaceControladorRequisicao
{
    use RenderizadorDeHtmlTrait;
    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if(is_null($id) || $id === false) {
            header('Location: /listar-cursos');
            return;
        }

        /** @var Curso $curso */
        $curso = $this->repositorioDeCursos->find($id);
        echo $this->renderizaHtml('cursos/formulario.php', [
            //extract-> ex: cria uma variavel com o nome 'curso' e atribui o valor de $curso pra ela
            'curso' => $curso,
            'titulo' => 'Alterar curso ' . $curso->getDescricao()
        ]);

    }
}