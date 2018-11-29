<?php

namespace RecomendaGrade\Visao;

class VisaoAluno {

	private $modelo;

	public function __construct(\RecomendaGrade\Modelo\ModeloAluno $modelo){
		$this->modelo = $modelo;
	}

	public function printarAluno(\RecomendaGrade\Modelo\Aluno $aluno) {
		$alunoArr = array(
			"id" => $aluno->getId(),
			"nomeAluno" => $aluno->getNomeAluno(),
			"email" => $aluno->getEmail(),
			"dataCadastro" => $aluno->getDataCadastro(),
			"permissao" => $aluno->getTipo(),
			"disciplinas" => []
		);

		foreach($aluno->getDisciplinas() as $disciplina) {
			$alunoArr['disciplinas'][] = array(
				"id" => $disciplina->getId(),
				"nome" => $disciplina->getNome(),
				"periodo" => $disciplina->getPeriodo(),
				"creditos" => $disciplina->getCreditos(),
				"cargaHoraria" => $disciplina->getCargaHoraria(),
				"cor" => $disciplina->getCor(),
				"idCurso" => $curso->getId(),
				"dataCadastro" => $disciplina->getDataCadastro(),
				"requisitos" => $disciplina->getRequisitos()
			);
		}

		echo json_encode($alunoArr);
	}

}
?>
