<?php
namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleDisciplina {

	private $modelo;

	public function __construct(Modelo\ModeloDisciplina $modelo){
		$this->modelo = $modelo;
	}


		// primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);


		$Disciplina->setNome($nome);
		$Disciplina->setPeriodo($periodo);
		$Disciplina->setCreditos($creditos);
		$Disciplina->setCargaHoraria($cargaHoraria);
		$Disciplina->setIdCurso($idCurso);
		$Disciplina->setDataCadastro($dataCadastro);

		return $this->modelo->salvarDisciplina($Disciplina);
	}
}
?>
