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

    public login($login, $senha){
        $stmt = $this->conexao->prepare("SELECT * FROM aluno WHERE login = :login and senha = :senha");

		$resultado = $stmt->execute(
            array(
                    ":login" => $login,
                    ":senha" => $senha
                )
            );

        if($resultado == 0){
            return null;
        }

        return true;

    }// fim do metodo


    public buscarAluno(int $id){

    }

}// fim da classe
