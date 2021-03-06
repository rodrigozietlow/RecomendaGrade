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
		$cor = $dados['cor'] ?? 0;
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

		// validação da cor
		if(!is_numeric($cor) || $cor < 0 || $cor > 127) {
			header("HTTP/1.1 422 Unprocessable Entity: Cor");
			die();
		}



		// criar um objeto disciplinas
		$Disciplina = new Modelo\Disciplina($nome, $periodo, $creditos, $cargaHoraria, $cor, $idCurso, $dataCadastro);

		$resultado = $this->modelo->salvarDisciplina($Disciplina);

		$requisitos = $dados['requisitos'] ?? array();

		$resultado = $resultado && $this->modelo->salvarRequisitos($Disciplina, $requisitos);

		$this->salvarCoRequisitoDisciplinaRelacionada($Disciplina, $requisitos);

		return $resultado;
	}

	//quando uma disciplina tem co-requisito a disciplina relacionada deve ter co-requisito também
	public function salvarCoRequisitoDisciplinaRelacionada($Disciplina, $requisitos){

		//verifica se tem requisitos
		if(count($requisitos) > 0){

			foreach ($requisitos as $req) {

				if($req['tipoRequisito'] == 2){

					$idDisciplinaRelacionada = $req['idRequisito'];

					$requisitoRelacionado['idDisciplina'] = $req['idRequisito'];      // sim tem que ser trocado
					$requisitoRelacionado['idRequisito'] = $Disciplina->getId();
					$requisitoRelacionado['tipoRequisito'] = $req['tipoRequisito'];


					$DisciplinaModelo = new Modelo\ModeloDisciplina($this->modelo->getConexao());
					$DisciplinaRelacionada = $DisciplinaModelo->buscarDisciplina($idDisciplinaRelacionada);

					$this->modelo->salvarRequisitos($DisciplinaRelacionada, array($requisitoRelacionado));

				}// fim do if

			}//fim do for

		}//fim do if de verificacao se tem requisitos

	}//fim da funcao


	public function editar($id){

		$Disciplina = $this->modelo->buscarDisciplina($id);

		if($Disciplina == NULL){
			// nós deveríamos jogar um erro aqui...

			header("HTTP/1.1 404 Not Found: Disciplina");
			die();
		}

		// primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

		$idCurso = $dados['idCurso'] ?? 0;

		$CursoModelo = new Modelo\ModeloCurso($this->modelo->getConexao());
		$Curso = $CursoModelo->buscarCurso($idCurso);

		if($Curso == NULL){
			// nós deveríamos jogar um erro aqui...
			header("HTTP/1.1 404 Not Found: Curso");
			die();
		}

		$nome = $dados['nome'] ?? "";
		$periodo = $dados['periodo'] ?? 0;
		$creditos = $dados['creditos'] ?? 0;
		$cargaHoraria = $dados['cargaHoraria'] ?? 0;
		$cor = $dados['cor'] ?? 0;

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

		// validação da cor
		if(!is_numeric($cor) || $cor < 0 || $cor > 127) {
			header("HTTP/1.1 422 Unprocessable Entity: Cor $cor");
			die();
		}

		// validar o período vs o período de prés e cos

		$requisitos = $dados['requisitos'] ?? array();

		foreach($Curso->getDisciplinas() as $disciplina) {
			foreach($requisitos as $requisito) {

				if($requisito['idRequisito'] == $disciplina->getId()){ // é a disciplina

					if(($periodo <= $disciplina->getPeriodo() && $requisito['tipoRequisito'] == 1) || ($periodo != $disciplina->getPeriodo() && $requisito['tipoRequisito'] == 2)){
						header("HTTP/1.1 422 Unprocessable Entity: Requisitos");
						die();
					}
				}
			}

		}

		// passou pela validação

		$Disciplina->setNome($nome);
		$Disciplina->setPeriodo($periodo);
		$Disciplina->setCor($cor);
		$Disciplina->setCreditos($creditos);
		$Disciplina->setCargaHoraria($cargaHoraria);

		$resultado = $this->modelo->salvarDisciplina($Disciplina);

		$resultado = $resultado && $this->modelo->excluirRequisitos($Disciplina);


		$resultado = $resultado && $this->modelo->salvarRequisitos($Disciplina, $requisitos);

		$this->salvarCoRequisitoDisciplinaRelacionada($Disciplina, $requisitos);

		return $resultado;
	}


	public function excluir($id){
		$Disciplina = $this->modelo->buscarDisciplina($id);

		if($Disciplina == NULL){
			// nós deveríamos jogar um erro aqui...

			header("HTTP/1.1 404 Not Found: Disciplina");
			die();
		}
		return $resultado = $this->modelo->excluirDisciplina($Disciplina);



	}
}
?>
