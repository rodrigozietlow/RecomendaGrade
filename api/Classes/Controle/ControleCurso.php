<?php
namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleCurso {

	private $modelo;

	public function __construct(Modelo\ModeloCurso $modelo){
		$this->modelo = $modelo;
	}

	public function editar($id){

		$Curso = $this->modelo->buscarCurso($id);

		if($Curso == NULL){
			// nós deveríamos jogar um erro aqui...
			header("HTTP/1.1 404 Not Found");
			die();
		}


		// primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);


		$dados['publico'] = $dados['publico'] ?? false;
		if($dados['publico']){
			$dados['publico'] = 1;
		}else{
			$dados['publico'] = 0;
		}
		

		// validação aqui TODO

		$Curso->setNomeCurso($dados['nomeCurso']);
		$Curso->setNomePeriodos($dados['nomePeriodos']);
		$Curso->setQtPeriodos($dados['qtPeriodos']);
		$Curso->setCargaMinima($dados['cargaMinima']);
		$Curso->setPublico($dados['publico']);

		return $this->modelo->SalvarCurso($Curso);
	}
}
?>
