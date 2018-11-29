<?php

namespace RecomendaGrade\Modelo;

class ModeloDisciplina {

	private $conexao;

	public function __construct(\PDO $conexao){
		$this->conexao = $conexao;
	}
	public function getConexao(){
		return $this->conexao;
	}

	public function buscarDisciplina($id){
		$stmt = $this->conexao->prepare("SELECT * FROM disciplina WHERE id = :id ORDER BY periodo"); // buscar as informações do curso
		$stmt->execute(array(":id" => $id));

		while($resultado = $stmt->fetch(\PDO::FETCH_ASSOC)){ // só tem um

			$requisitos = array();

			$stmtReq = $this->conexao->prepare("SELECT * FROM requisito WHERE idDisciplina = :id");
			$stmtReq->execute(array(":id" => $resultado['id']));

			while($resultadoReq = $stmtReq->fetch(\PDO::FETCH_ASSOC)){
				$requisitos[] = $resultadoReq;
			}
			$disciplina = new Disciplina($resultado['nome'], $resultado['periodo'], $resultado['creditos'], $resultado['cargaHoraria'], $resultado['cor'], $resultado['idCurso'], $resultado['dataCadastro'], $requisitos, $resultado['id']);
			return $disciplina;
		}
		return null;
	}

	public function buscarDisciplinasCurso($idCurso){
		$stmt = $this->conexao->prepare("SELECT * FROM disciplina WHERE idCurso = :idCurso ORDER BY periodo");
		$stmt->execute(array(":idCurso" => $idCurso));

		$disciplinas = array();

		while($resultado = $stmt->fetch(\PDO::FETCH_ASSOC)){
			// buscar requisitos
			$requisitos = array();

			$stmtReq = $this->conexao->prepare("SELECT * FROM requisito WHERE idDisciplina = :id");
			$stmtReq->execute(array(":id" => $resultado['id']));

			while($resultadoReq = $stmtReq->fetch(\PDO::FETCH_ASSOC)){
				$requisitos[] = $resultadoReq;
			}

			$disciplinas[] = new Disciplina($resultado['nome'], $resultado['periodo'], $resultado['creditos'], $resultado['cargaHoraria'], $resultado['cor'], $resultado['idCurso'], $resultado['dataCadastro'], $requisitos, $resultado['id']);


		}

		return $disciplinas;
	}

	public function salvarDisciplina (Disciplina $disciplina){
		$id = $disciplina->getId();
		if(empty($id)){

			$stmt = $this->conexao->prepare("INSERT INTO disciplina(nome, periodo, creditos, cargaHoraria, cor, idCurso, dataCadastro) VALUES (:nome, :periodo, :creditos, :cargaHoraria, :cor, :idCurso, :dataCadastro)");

			$resultado = $stmt->execute(
				array(
					":nome" => $disciplina->getNome(),
					":periodo" => $disciplina->getPeriodo(),
					":creditos" => $disciplina->getCreditos(),
					":cargaHoraria" => $disciplina->getCargaHoraria(),
					":cor" => $disciplina->getCor(),
					":idCurso" => $disciplina->getIdCurso(),
					":dataCadastro" => $disciplina->getDataCadastro()
				)
			);

			$disciplina->setId($this->conexao->lastInsertId());

			return $resultado;
		}else{
			$stmt = $this->conexao->prepare("UPDATE disciplina SET nome= :nome, periodo= :periodo, creditos= :creditos, cor = :cor, cargaHoraria= :cargaHoraria WHERE id = :id");

			$resultado = $stmt->execute(
				array(
					":nome" => $disciplina->getNome(),
					":periodo" => $disciplina->getPeriodo(),
					":creditos" => $disciplina->getCreditos(),
					":cargaHoraria" => $disciplina->getCargaHoraria(),
					":cor" => $disciplina->getCor(),
					":id" => $disciplina->getId()

				)
			);

			return $resultado;

		}
	}

	public function salvarRequisitos($disciplina, $requisitos){
		$resultado = TRUE;

		if(count($requisitos) > 0){
			$stmt = $this->conexao->prepare("INSERT into requisito(idDisciplina, idRequisito, tipoRequisito) VALUES (:idDisciplina, :idRequisito, :tipoRequisito)");

			foreach ($requisitos as $requisito) {
				$requisitoObj = array(
					":idDisciplina" => $disciplina->getId(),
					":idRequisito" => $requisito['idRequisito'],
					":tipoRequisito" => $requisito['tipoRequisito'],
				);

				$novosRequisitos = $disciplina->getRequisitos();
				$novosRequisitos[] = $requisitoObj;
				$disciplina->setRequisitos($novosRequisitos);

				$resultado = $resultado && $stmt->execute($requisitoObj);
			}

		}

		return $resultado;
	}

	public function excluirRequisitos($disciplina){
		$stmt = $this->conexao->prepare("DELETE FROM requisito WHERE idDisciplina = :idDisciplina");
		return $stmt->execute(array(":idDisciplina" => $disciplina->getId()));
	}

	public function excluirDisciplina($disciplina){
		$stmtReq = $this->conexao->prepare("DELETE FROM requisito WHERE idDisciplina = :idDisciplina OR idRequisito = :idRequisito");
		$retorno = $stmtReq->execute(array(
			":idDisciplina" => $disciplina->getId(),
			":idRequisito" => $disciplina->getId()
		));

		$stmtDis = $this->conexao->prepare("DELETE FROM disciplina WHERE id = :idDisciplina");
		return $retorno && $stmtDis->execute(array(":idDisciplina" => $disciplina->getId()));
	}


	public function excluirCursada($idDisciplina) {
		$stmt = $this->conexao->prepare("DELETE FROM disciplinas_aluno WHERE idAluno = :idAluno AND idDisciplina = :idDisciplina");
		// print_r($_SESSION);
		return $stmt->execute(array(
			":idAluno" => $_SESSION['aluno']->getId(),
			":idDisciplina" => $idDisciplina
		));
	}

	public function inserirCursada($idDisciplina) {
		$stmt = $this->conexao->prepare("INSERT INTO disciplinas_aluno(idAluno, idDisciplina) VALUES(:idAluno, :idDisciplina)");
		// print_r($_SESSION);
		return $stmt->execute(array(
			":idAluno" => $_SESSION['aluno']->getId(),
			":idDisciplina" => $idDisciplina
		));
	}
}
