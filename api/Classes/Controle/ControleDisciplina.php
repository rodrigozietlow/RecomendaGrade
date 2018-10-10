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
		$dataCadastro = date("Y-m-d");
		$idCurso = $dados['idCurso'] ?? 1;

		$CursoModelo = new Modelo\ModeloCurso($this->modelo->getConexao());
		$Curso = $CursoModelo->buscarCurso($idCurso);
		$maxPeriodo = $Curso->getQtPeriodos();
		$maxCarga = $Curso->getCargaMinima();

		//validação

		// validação do nome das disciplinas
		if(!$nome || strlen($nome) > 100){
			header("HTTP/1.1 422 Unprocessable Entity: Nome da disciplina");
			die();
		}

		// validação do total de períodos   - ver $maxPeriodo de periodo como puxar
		if(!is_numeric($periodo) || $periodo <= 0 || $periodo > $maxPeriodo){
			header("HTTP/1.1 422 Unprocessable Entity: Período da disciplina");
			die();
		}

		// validação do total de creditos
		if(!is_numeric($creditos) || $creditos <= 0 || $creditos > 127){
			header("HTTP/1.1 422 Unprocessable Entity: Créditos da disciplina");
			die();
		}

		// validação da carga Horária
		if(!is_numeric($cargaHoraria) || $cargaHoraria <= 0 || $cargaHoraria > $maxCarga){
			header("HTTP/1.1 422 Unprocessable Entity: Carga Horária da disciplina");
			die();
		}



		// criar um objeto disciplinas
		$Disciplina = new Modelo\Disciplina($nome, $periodo, $creditos, $cargaHoraria, $idCurso, $dataCadastro);

		$resultado = $this->modelo->salvarDisciplina($Disciplina);

		$requisitos = $dados['requisitos'] ?? array();

		$resultado = $resultado && $this->modelo->salvarRequisitos($Disciplina, $requisitos);

		return $resultado;
	}

	public function editar($id){

		$Disciplina = $this->modelo->buscarDisciplina($id);

		if($Disciplina == NULL){
			// nós deveríamos jogar um erro aqui...
			header("HTTP/1.1 404 Not Found");
			die();
		}

		// primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

		$idCurso = $dados['idCurso'] ?? 0;

		$CursoModelo = new Modelo\ModeloCurso($this->modelo->getConexao());
		$Curso = $CursoModelo->buscarCurso($idCurso);

		if($Curso == NULL){
			// nós deveríamos jogar um erro aqui...
			header("HTTP/1.1 404 Not Found");
			die();
		}

		$nome = $dados['nome'] ?? "";
		$periodo = $dados['periodo'] ?? 0;
		$creditos = $dados['creditos'] ?? 0;
		$cargaHoraria = $dados['cargaHoraria'] ?? 0;
		$dataCadastro = date("Y-m-d");

		$maxPeriodo = $Curso->getQtPeriodos();
		$maxCarga = $Curso->getCargaMinima();

		//validação

		// validação do nome das disciplinas
		if(!$nome || strlen($nome) > 25){
			header("HTTP/1.1 422 Unprocessable Entity: Nome da disciplina");
			die();
		}

		// validação do total de períodos   - ver $maxPeriodo de periodo como puxar
		if(!is_numeric($periodo) || $periodo <= 0 || $periodo > $maxPeriodo){
			header("HTTP/1.1 422 Unprocessable Entity: Período da disciplina");
			die();
		}

		// validação do total de creditos
		if(!is_numeric($creditos) || $creditos <= 0 || $creditos > 127){
			header("HTTP/1.1 422 Unprocessable Entity: Créditos da disciplina");
			die();
		}

		// validação da carga Horária
		if(!is_numeric($cargaHoraria) || $cargaHoraria <= 0 || $cargaHoraria > $maxCarga){
			header("HTTP/1.1 422 Unprocessable Entity: Carga Horária da disciplina");
			die();
		}



		// criar um objeto disciplinas
		$Disciplina = new Modelo\Disciplina($nome, $periodo, $creditos, $cargaHoraria, $idCurso, $dataCadastro);

		$resultado = $this->modelo->salvarDisciplina($Disciplina);

		$requisitos = $dados['requisitos'] ?? array();

		$resultado = $resultado && $this->modelo->salvarRequisitos($Disciplina, $requisitos);

		return $resultado;
	}
}
?>
