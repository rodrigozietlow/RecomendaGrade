<?php
namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleDisciplina {

	private $modelo;

	public function __construct(Modelo\ModeloDisciplina $modelo){
		$this->modelo = $modelo;
	}

	public function salvar(){


		// primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

		$nome = $dados['nome'] ?? "";
		$periodo = $dados['periodo'] ?? 0;
		$creditos = $dados['creditos'] ?? 0;
		$cargaHoraria = $dados['cargaHoraria'] ?? 0;
		$idCurso = $dados['idCurso'] ?? 1;
		$dataCadastro = date("Y-m-d");

		//validação


		// criar um objeto disciplinas
		$Disciplina = new Modelo\Disciplina($nome, $periodo, $creditos, $cargaHoraria, $idCurso, $dataCadastro);

		$Disciplina->setNome($nome);
		$Disciplina->setPeriodo($periodo);
		$Disciplina->setCreditos($creditos);
		$Disciplina->setCargaHoraria($cargaHoraria);
		$Disciplina->setIdCurso($idCurso);
		$Disciplina->setDataCadastro($dataCadastro);



		return $this->modelo->salvarDisciplina($Disciplina);
	}

	public function editar($id){


		return false;
	}
}
?>
