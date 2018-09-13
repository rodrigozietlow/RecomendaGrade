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
			$disciplinas[] = new Disciplina($resultado['nome'], $resultado['periodo'], $resultado['creditos'], $resultado['cargaHoraria'], $resultado['idCurso'], $resultado['dataCadastro'], $resultado['id']);
		}

		return $disciplinas;
	}

	public function criarDisciplina (Disciplina $disciplina){
		$stmt = $this->conexao->prepare("INSERT INTO disciplina (nome = :nome, periodo = :periodo, creditos = :creditos, cargaHoraria = :cargaHoraria, idCurso = :idCurso, dataCadastro = :dataCadastro");

		return $stmt->execute(
			array(
				":nome" => $disciplina->getNome(),
				":periodo" => $disciplina->getPeriodo(),
				":creditos" => $disciplina->getCreditos(),
				":cargaHoraria" => $disciplina->getCargaHoraria(),
				":idCurso" => $disciplina->getIdCurso(),
				":dataCadastro" => $disciplina->getDataCadastro()
			)
		);
	}



}
