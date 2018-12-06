<?php

namespace RecomendaGrade\Modelo;

class ModeloAluno{

	private $conexao;

	public function __construct(\PDO $conexao){
		$this->conexao = $conexao;
	}
	public function getConexao(){
		return $this->conexao;
	}

	//se encontrar vai retornar true, caso não escontrar retorna false
	public function login($email, $inputSenha){
		$resultado = $this->buscarAlunoEmail($email);
		//se encontrou o email verifica se a senha é compativel

		if($resultado && $this->validarSenha($inputSenha, $resultado->getSenhaHash())){
			return $this->buscarAluno($resultado->getId());
		} else{
			return false;
		}
	}


	public function validarSenha($inputSenha, $hash){
		return password_verify($inputSenha, $hash);
	}


	public function criptografarSenha($inputSenha){
		return password_hash($inputSenha, PASSWORD_DEFAULT);
	}


	public function buscarAluno(int $id){
		$stmt = $this->conexao->prepare("SELECT * FROM aluno WHERE id = :id");
		$stmt->execute(
			array(
				":id" => $id
			)
		);
		$resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		if($resultado) {
			$Aluno =  new Aluno($resultado['nomeAluno'], $resultado['email'], $resultado['dataCadastro'], $resultado['senhaHash'], $resultado['tipo'], $resultado['id']);

			// buscar as disciplinas já cursadas
			$stmt = $this->conexao->prepare('SELECT * FROM disciplinas_aluno WHERE idAluno = :idAluno');
			$stmt->execute(array(
				':idAluno' => $Aluno->getId()
			));

			$modeloDisciplina = new \RecomendaGrade\Modelo\ModeloDisciplina($this->conexao);

			$disciplinas = [];
			while($resultado = $stmt->fetch(\PDO::FETCH_ASSOC)){
				// print_r($resultado);
				$disciplinas[] = $modeloDisciplina->buscarDisciplina($resultado['idDisciplina']);
			}
			$Aluno->setDisciplinas($disciplinas);

			return $Aluno;
		}

		return null;
	}

	public function buscarAlunoEmail(string $email) {
		$stmt = $this->conexao->prepare("SELECT * FROM aluno WHERE email = :email");
		$stmt->execute(
			array(
				":email" => $email
			)
		);
		$resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		if($resultado) {
			return new Aluno($resultado['nomeAluno'], $resultado['email'], $resultado['dataCadastro'], $resultado['senhaHash'], $resultado['tipo'], $resultado['id']);
		}

		return null;
	}


	public function validarEmail($email, $idComparativo = null){
		if($idComparativo != null){
			return !empty($this->buscarAlunoEmail($email)) && $this->buscarAlunoEmail($email)->getId() != $idComparativo;
		}
		return !empty($this->buscarAlunoEmail($email));
	}

	public function salvar(Aluno $aluno){
		$id = $aluno->getId();
		if(empty($id)){
			//Novo cadastro
			$stmt = $this->conexao->prepare("INSERT INTO aluno(nomeAluno, email, dataCadastro, senhaHash, tipo) VALUES (:nomeAluno, :email, :dataCadastro, :senhaHash, :tipo)");

			$resultado = $stmt->execute(
				array(
					":nomeAluno" => $aluno->getNomeAluno(),
					":email" => $aluno->getEmail(),
					":dataCadastro" => $aluno->getDataCadastro(),
					":senhaHash" => $aluno->getSenhaHash(),
					":tipo" => $aluno->getTipo()
				)
			);

			$aluno->setId($this->conexao->lastInsertId());
			return $resultado;
		}else{
			//edição
			$stmt = $this->conexao->prepare("UPDATE aluno SET nomeAluno= :nomeAluno, email= :email, dataCadastro= :dataCadastro, senhaHash = :senhaHash, tipo= :tipo WHERE id = :id");

			$resultado = $stmt->execute(
				array(
					":nomeAluno" => $aluno->getNomeAluno(),
					":email" => $aluno->getEmail(),
					":dataCadastro" => $aluno->getDataCadastro(),
					":senhaHash" => $aluno->getSenhaHash(),
					":tipo" => $aluno->getTipo(),
					":id" => $aluno->getId()
				)
			);

			return $resultado;

		}
	} //fim função salvar

	public function salvarCursosAluno($Aluno, $cursos){
		$resultado = TRUE;

		if(count($cursos) > 0){
			$stmt = $this->conexao->prepare("INSERT into cursos_aluno(idCurso, idAluno) VALUES (:idCurso, :idAluno)");

			//se está editando limpa a lista e insere novamente os cursos
			$this->excluirCursosAluno($Aluno);

			foreach ($cursos as $curso) {
				$cursoObj = array(
					":idAluno" => $Aluno->getId(),
					":idCurso" => $curso,
				);

				$resultado = $resultado && $stmt->execute($cursoObj);
			}
		}

		return $resultado;
	}
	public function excluirCursosAluno($aluno){
		$stmt = $this->conexao->prepare("DELETE FROM cursos_aluno WHERE idAluno = :idAluno");
		return $stmt->execute(array(":idAluno" => $aluno->getId()));
	}
}// fim da classe
