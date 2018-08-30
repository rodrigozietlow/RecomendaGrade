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
			$cursoArray['publico'] = $curso->getpublico();
			$cursoArray['disciplinas'] = array();

			foreach ($curso->getDisciplinas() as $disciplina) {
					$cursoArray['disciplinas'][] = array(
							"id" => $disciplina->getId(),
							"nome" => $disciplina->getNome(),
							"periodo" => $disciplina->getPeriodo(),
							"creditos" => $disciplina->getCreditos(),
							"cargaHoraria" => $disciplina->getCargaHoraria(),
							"idCurso" => $curso->getId(),
							"dataCadastro" => $disciplina->getDataCadastro()
					);
					/*	private $id;
						private $nome;
						private $periodo;
						private $creditos;
						private $cargaHoraria;
						private $idCurso;
						private $dataCadastro;*/
			}

			//$cursoArray['disciplinas'] = $curso->getDisciplinas();
			echo json_encode($cursoArray, 1);
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
