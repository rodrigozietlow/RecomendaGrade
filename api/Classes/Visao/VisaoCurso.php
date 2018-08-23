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
