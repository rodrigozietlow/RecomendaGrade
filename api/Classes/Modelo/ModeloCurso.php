<?php
namespace RecomendaGrade\Modelo;

class ModeloCurso {

	private $conexao;

	public function __construct(\PDO $conexao){
		$this->conexao = $conexao;
	}

	public function buscarCurso($id){
		$stmt = $this->conexao->prepare("SELECT * FROM curso WHERE id = :id"); // buscar as informações do curso
		$stmt->execute(array(":id" => $id));

		while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){ // só tem um

			// buscar as disciplinas do curso
			//TODO
			$disciplinas = array();

			$curso = new Curso($resultado['nomeCurso'], $resultado['nomePeriodos'], $resultado['qtPeriodos'], $resultado['cargaMinima'], $resultado['idCoordenador'], $resultado['publico'], $resultado['dataCadastro'], $disciplinas, $resultado['id']);
			
			return $curso;
		}
		return null;
	}
}
