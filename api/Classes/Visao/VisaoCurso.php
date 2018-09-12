<?php
namespace RecomendaGrade\Visao;

class VisaoCurso {

	private $modeloCurso;

	public function __construct(\RecomendaGrade\Modelo\ModeloCurso $modelo){
		$this->modeloCurso = $modelo;
	}

	public function buscar($idCurso){
		$curso = $this->modeloCurso->buscarCurso($idCurso);

		if($curso == null){
			// emitir um erro
		}
		else{

			$cursoArray = array();
			$cursoArray['id'] = $curso->getId();
			$cursoArray['nomeCurso'] = $curso->getNomeCurso();
			$cursoArray['nomePeriodos'] = $curso->getnomePeriodos();
			$cursoArray['qtPeriodos'] = $curso->getqtPeriodos();
			$cursoArray['cargaMinima'] = $curso->getcargaMinima();
			$cursoArray['dataCadastro'] = $curso->getdataCadastro();
			$cursoArray['publico'] = $curso->getpublico() ? "true" : "false";
			$cursoArray['disciplinas'] = array();


			foreach ($curso->getDisciplinas() as $disciplina) {
				//print_r($disciplina);
				$array = array(
					"id" => $disciplina->getId(),
					"nome" => utf8_encode($disciplina->getNome()),
					"periodo" => $disciplina->getPeriodo(),
					"creditos" => utf8_encode($disciplina->getCreditos()),
					"cargaHoraria" => $disciplina->getCargaHoraria(),
					"idCurso" => $curso->getId(),
					"dataCadastro" => $disciplina->getDataCadastro(),
				);
				//print_r($array);
				$cursoArray['disciplinas'][] = $array;
			}
			//$cursoArray['disciplinas'] = $curso->getDisciplinas();
			echo json_encode($cursoArray, JSON_UNESCAPED_UNICODE);
		}
	}

	public function publicarCurso($idCurso){
			$curso = $this->modeloCurso->publicarCurso($idCurso);

			if($curso){ // publicou
				$texto = "Curso Publicado com Sucesso";
				echo json_encode($texto);
			}
			else{
				// emitir um erro
			}

	}

	public function listar(){

	}
}
