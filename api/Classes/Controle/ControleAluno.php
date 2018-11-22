<?php

namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleAluno{

    private $modelo;

    public function __construct(Modelo\ModeloAluno $modelo){
        $this->modelo = $modelo;
    }

    public function salvar(){

        // primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

        print_r($dados);

		$nomeAluno = $dados['nomeAluno'] ?? "";
		$email = $dados['email'] ?? 0;
		$senhaHash = $dados['senhaHash'] ?? 0;
		$dataCadastro = date("Y-m-d");
		$tipo = 3;

		// criar um objeto aluno
		$Aluno = new Modelo\Aluno($nomeAluno, $email, $senhaHash, $dataCadastro, $tipo);

		$resultado = $this->modelo->salvar($Aluno);

		return $resultado;
        /*

        if(isEmailCadastrado($dados['email'])){
            header("HTTP/1.1 401 Unauthorized");
            die();
        }

        //colocar aqui a função de salvar o cadastro de usuario
        */

    }//fim da funcao salvar

    //função para verificar e validar se o email será único
    public function isEmailCadastrado($email){
        return $this->modelo->validarEmail($email);
    }


}// fim da classe

?>
