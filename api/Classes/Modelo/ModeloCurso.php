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

		while($resultado = $stmt->fetch(\PDO::FETCH_ASSOC)){ // só tem um

			// buscar as disciplinas do curso
			$modeloDisciplinas = new ModeloDisciplina($this->conexao);

			$disciplinas = $modeloDisciplinas->buscarDisciplinasCurso($resultado['id']);

			$curso = new Curso($resultado['nomeCurso'], $resultado['nomePeriodos'], $resultado['qtPeriodos'], $resultado['cargaMinima'], $resultado['idCoordenador'], $resultado['publico'], $resultado['dataCadastro'], $disciplinas, $resultado['id']);

			return $curso;
		}
		return null;
	}

	public function publicarCurso($id){

		$stmt = $this->conexao->prepare("SELECT * FROM curso WHERE id = :id"); // buscar as informações do curso
		$stmt->execute(array(":id" => $id));

		while($resultado = $stmt->fetch(\PDO::FETCH_ASSOC)){ // só tem um

			// buscar as disciplinas do curso
			$modeloDisciplinas = new ModeloDisciplina($this->conexao);

			$disciplinas = $modeloDisciplinas->buscarDisciplinasCurso($resultado['id']);

		}

		if(empty($disciplinas)){
			return false; //não possui disciplinas cadastrada
		}else{
			return true; //possui disciplinas cadastrada

			//alterar o status de publico para 1 ou true
		}

	}

	public function salvarCurso(Curso $curso){
		$stmt = $this->conexao->prepare("UPDATE curso SET nomeCurso = :nomeCurso, nomePeriodos = :nomePeriodos, qtPeriodos = :qtPeriodos, cargaMinima = :cargaMinima, publico = :publico WHERE id = :id");

		return $stmt->execute(
			array(
				":nomeCurso" => $curso->getNomeCurso(),
				":nomePeriodos" => $curso->getNomePeriodos(),
				":qtPeriodos" => $curso->getQtPeriodos(),
				":cargaMinima" => $curso->getCargaMinima(),
				":id" => $curso->getId(),
				":publico" => $curso->getPublico()
			)
		);
	}

}
