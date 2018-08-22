<?php

namespace RecomendaGrade\Modelo;

class ModeloDisciplina {

	private $conexao;

	public function __construct(\PDO $conexao){
		$this->conexao = $conexao;
	}

	public function buscarDisciplina($id){
		// TODO
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

}
