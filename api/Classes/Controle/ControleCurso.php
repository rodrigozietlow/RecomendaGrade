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

		//Mínimo de periodos permitidos no curso
		$periodoMin = 1;
		foreach($Curso->getDisciplinas() as $disciplina) {
			if($disciplina->getPeriodo() > $periodoMin){
				$periodoMin = $disciplina->getPeriodo();
			}

		}


		// primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);


		$publico = $dados['publico'] ?? false;
		if($publico){
			$publico = 1;
		}else{
			$publico = 0;
		}


		// validação

		$nomePeriodos = $dados['nomePeriodos'] ?? "";
		$qtPeriodos = $dados['qtPeriodos'] ?? 0;
		$cargaMinima = $dados['cargaMinima'] ?? 0;

		// validação do nome do curso??
		//$Curso->setNomeCurso($dados['nomeCurso']); // -> não altera

		// validação do nome dos períodos
		if(!$nomePeriodos || strlen($nomePeriodos) > 25){
			header("HTTP/1.1 422 Unprocessable Entity: Nome dos periodos");
			die();
		}

		// validação do total de períodos
		if(!is_numeric($qtPeriodos) || $qtPeriodos < $periodoMin || $qtPeriodos > 127){
			header("HTTP/1.1 422 Unprocessable Entity: Quantidade de periodos");
			die();
		}

		// validação da carga horária
		if(!is_numeric($cargaMinima) || $cargaMinima <= 0 || $cargaMinima > 999999.99){
			header("HTTP/1.1 422 Unprocessable Entity: Carga horaria minima");
			die();
		}


		$Curso->setNomePeriodos($nomePeriodos);
		$Curso->setQtPeriodos($qtPeriodos);
		$Curso->setCargaMinima($cargaMinima);
		$Curso->setPublico($publico);

		return $this->modelo->SalvarCurso($Curso);
	}
}
?>
