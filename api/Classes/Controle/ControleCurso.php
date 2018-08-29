<?php
namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleCurso {

	private $modelo;

	public function __construct(Modelo\ModeloCurso $modelo){
		$this->modelo = $modelo;
	}

	public function editar(){
		// primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);


		// validação aqui TODO

		$id = $dados['id'];
		$nomeCurso = $dados['nomeCurso'];
		$nomePeriodos = $dados['nomePeriodos'];
		$qtPeriodos = $dados['qtPeriodos'];
		$cargaMinima = $dados['cargaMinima'];
		$idCoordenador = $dados['idCoordenador'];
		$publico = $dados['publico'];
		$dataCadastro = $dados['dataCadastro'];
		$disciplinas = array();

		// criar o curso
		$curso = new Modelo\Curso($nomeCurso, $nomePeriodos, $qtPeriodos, $cargaMinima, $idCoordenador, $publico, $dataCadastro, $disciplinas, $id);

		return $this->modelo->SalvarCurso($curso);
	}
}
?>
