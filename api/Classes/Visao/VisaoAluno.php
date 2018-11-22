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
			"permissao" => $aluno->getTipo()
		);

		echo json_encode($alunoArr);
	}

}
?>
