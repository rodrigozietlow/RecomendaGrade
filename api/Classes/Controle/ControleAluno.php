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
        /*

        if(isEmailCadastrado($dados['email'])){
            header("HTTP/1.1 401 Unauthorized");
            die();
        }

        //colocar aqui a função de salvar o cadastro de usuario
        */

    }//fim da funcao

    //função para verificar e validar se o email será único
    public function isEmailCadastrado($email){
        return $this->modelo->validarEmail($email);
    }


    //esse codigo recortar e colar no ModeloAluno (arquivo sendo editado por outro colaborador)
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


}// fim da classe

?>
