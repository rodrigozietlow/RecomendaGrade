<?php
namespace RecomendaGrade\Modelo;

class ModeloCurso {

	private $conexao;

	public function __construct(\PDO $conexao){
		$this->conexao = $conexao;
	}
	public function getConexao(){
		return $this->conexao;
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
	public function buscarCursos(){
		$stmt = $this->conexao->prepare("SELECT curso.id, nomeCurso FROM curso"); // buscar as informações do curso
		$stmt->execute(array());

		$cursos = array();
		while($resultado = $stmt->fetch(\PDO::FETCH_ASSOC)){ // só tem um
			$cursos[] = $resultado;
		}
		return $cursos;
	}

	public function buscarCursosAluno(){
		// var_dump($_SESSION);
		$idAluno = $_SESSION['aluno']->getId();
		$stmt = $this->conexao->prepare("SELECT curso.id, nomeCurso FROM curso, cursos_aluno, aluno WHERE curso.id = idCurso  AND aluno.id = idAluno AND aluno.id = :idAluno "); // buscar as informações do curso
		$stmt->execute(array(":idAluno" => $idAluno));

		$cursos = array();
		while($resultado = $stmt->fetch(\PDO::FETCH_ASSOC)){ // só tem um
			$cursos[] = $resultado;
		}
		// print_r($cursos);
		return $cursos;
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
		if ($curso->getId() == NULL) {
			// print_r(
			// 	array(
			// 		":nomeCurso" => $curso->getNomeCurso(),
			// 		":nomePeriodos" => $curso->getNomePeriodos(),
			// 		":qtPeriodos" => $curso->getQtPeriodos(),
			// 		":cargaMinima" => $curso->getCargaMinima(),
			// 		":idCoordenador" => $curso->getIdCoordenador(),
			// 		":publico" => $curso->getPublico()
			// 	)
			// );
			$stmt = $this->conexao->prepare("INSERT INTO curso VALUES (NULL, :nomeCurso, :nomePeriodos, :qtPeriodos, :cargaMinima, :idCoordenador, :publico, CURDATE())");

			$resultado = $stmt->execute(
				array(
					":nomeCurso" => $curso->getNomeCurso(),
					":nomePeriodos" => $curso->getNomePeriodos(),
					":qtPeriodos" => $curso->getQtPeriodos(),
					":cargaMinima" => $curso->getCargaMinima(),
					":idCoordenador" => $curso->getIdCoordenador(),
					":publico" => $curso->getPublico()
				)
			);

			$curso->setId($this->conexao->lastInsertId());

			return $resultado;
		}
		else {
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

}
