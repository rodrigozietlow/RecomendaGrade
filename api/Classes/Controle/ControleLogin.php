<?php

namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleLogin{

    private $modelo;

    public function __construct(Modelo\ModeloAluno $modelo){
        $this->modelo = $modelo;
    }

    public function salvar(){

        // primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

        print_r($dados);

        return false;

        /*
        $acesso = $this->modelo->login($login, $senha);

        if($acesso == NULL){
            header("HTTP/1.1 401 Unauthorized");
            die();
        }

        return view();
        */

    }//fim da funcao

}// fim da classe

?>
