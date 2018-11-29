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
			return $resultado;
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
			return new Aluno($resultado['nomeAluno'], $resultado['email'], $resultado['dataCadastro'], $resultado['senhaHash'], $resultado['tipo'], $resultado['id']);
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


	public function validarEmail($email){
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

			foreach ($cursos as $curso) {
				$cursoObj = array(
					":idAluno" => $Aluno->getId(),
					":idCurso" => $curso,
				);

				$novosCursos = $Aluno->getCursos();
				$novosCursos[] = $cursoObj;
				$Aluno->setCursos($novosCursos);

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
