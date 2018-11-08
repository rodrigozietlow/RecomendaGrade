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

    public function login($login, $senha){
        $stmt = $this->conexao->prepare("SELECT * FROM aluno WHERE login = :login");
		$stmt->execute(array(":login" => $login));

        //se encontrar vai retornar true, caso não escontrar retorna false
         $stmt->fetch(\PDO::FETCH_ASSOC);

    }// fim do metodo

    public function criptografarSenha($senha){
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function validarSenha($senha, $hash){
        if (password_verify($senha, $hash)) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarAluno(int $id){

    }


    public function salvarAluno(){

        //usar o metodo criptografarSenha
        //criptografarSenha($senha);
    }

}// fim da classe
