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


    public function salvarAluno(){

        //usar o metodo criptografarSenha
        //criptografarSenha($senha);
    }

}// fim da classe
