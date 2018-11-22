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
        $stmt = $this->conexao->prepare("SELECT * FROM aluno WHERE email = :email");
		$stmt->execute(array(":email" => $email));

         $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

         //se encontrou o email verifica se a senha é compativel

         if($resultado){
             return $this->validarSenha($inputSenha, $resultado['senhaHash']);
         }else{
             return false;
         }


    }// fim do metodo
    public function validarSenha($inputSenha, $hash){
        if (password_verify($inputSenha, $hash)) {
            return true;
        } else {
            return false;
        }
    }


    public function criptografarSenha($inputSenha){
        return password_hash($inputSenha, PASSWORD_DEFAULT);
    }



    public function buscarAluno(int $id){

    }


	public function validarEmail($email){
		$stmt = $this->conexao->prepare("SELECT * FROM aluno WHERE email = :email");
		$stmt->execute(array(":email" => $email));

		 $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

		 //se true econtrou o email, se false não encontrou
		 if($resultado){
			 return true;
		 }else{
			 return false;
		 }
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






        //usar o metodo criptografarSenha
        //criptografarSenha($senha);
    }

}// fim da classe
