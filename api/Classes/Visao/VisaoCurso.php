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
			$cursoArray['publico'] = $curso->getpublico() ? true : false;
			$cursoArray['idCoordenador'] = $curso->getIdCoordenador();
			$cursoArray['disciplinas'] = array();


			foreach ($curso->getDisciplinas() as $disciplina) {
				//print_r($disciplina);
				$array = array(
					"id" => $disciplina->getId(),
					"nome" => $disciplina->getNome(),
					"periodo" => $disciplina->getPeriodo(),
					"creditos" => $disciplina->getCreditos(),
					"cargaHoraria" => $disciplina->getCargaHoraria(),
					"cor" => $disciplina->getCor(),
					"idCurso" => $curso->getId(),
					"dataCadastro" => $disciplina->getDataCadastro(),
					"requisitos" => $disciplina->getRequisitos(),
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
		if (empty($_SESSION['aluno'])){
			$cursos = $this->modeloCurso->buscarCursos();
			echo json_encode($cursos, JSON_UNESCAPED_UNICODE);

		}else{
			$cursos = $this->modeloCurso->buscarCursosAluno();
			echo json_encode($cursos, JSON_UNESCAPED_UNICODE);

		}

	}
}
