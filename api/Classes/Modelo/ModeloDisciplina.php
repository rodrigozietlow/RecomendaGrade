<?php

namespace RecomendaGrade\Modelo;

class ModeloDisciplina {

	private $conexao;

	public function __construct(\PDO $conexao){
		$this->conexao = $conexao;
	}

	/*
	$stmt2 = $this->conexao->prepare("SELECT * FROM disciplina WHERE idCurso = :idCurso");
	$stmt2->execute(array(":idCurso" => $resultado['id']));

	$disciplinas = array();

	while($resultado2)*/

}
