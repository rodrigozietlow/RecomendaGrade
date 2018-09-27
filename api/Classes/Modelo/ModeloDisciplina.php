<?php

namespace RecomendaGrade\Modelo;

class ModeloDisciplina {

	private $conexao;

	public function __construct(\PDO $conexao){
		$this->conexao = $conexao;
	}

	public function buscarDisciplina($id){
		// TODO

		// essa provavelmente tem pré e co requisitos
	}

	public function buscarDisciplinasCurso($idCurso){
		$stmt = $this->conexao->prepare("SELECT * FROM disciplina WHERE idCurso = :idCurso");
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

			$disciplinas[] = new Disciplina($resultado['nome'], $resultado['periodo'], $resultado['creditos'], $resultado['cargaHoraria'], $resultado['idCurso'], $resultado['dataCadastro'], $requisitos, $resultado['id']);


		}

		return $disciplinas;
	}

	public function salvarDisciplina (Disciplina $disciplina){
		$stmt = $this->conexao->prepare("INSERT INTO disciplina(nome, periodo, creditos, cargaHoraria, idCurso, dataCadastro) VALUES (:nome, :periodo, :creditos, :cargaHoraria, :idCurso, :dataCadastro)");

		$resultado = $stmt->execute(
			array(
				":nome" => $disciplina->getNome(),
				":periodo" => $disciplina->getPeriodo(),
				":creditos" => $disciplina->getCreditos(),
				":cargaHoraria" => $disciplina->getCargaHoraria(),
				":idCurso" => $disciplina->getIdCurso(),
				":dataCadastro" => $disciplina->getDataCadastro()
			)
		);

		$disciplina->setId($this->conexao->lastInsertId());

		return $resultado;
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



}
