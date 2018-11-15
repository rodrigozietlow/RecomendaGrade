<?php

namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleAluno{

    private $modelo;

    public function __construct(Modelo\ModeloAluno $modelo){
        $this->modelo = $modelo;
    }

    public function login(){

        // primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

        print_r($dados);

        /*
        $acesso = $this->modelo->login($login, $senha);

        if($acesso == NULL){
            header("HTTP/1.1 401 Unauthorized");
            die();
        }

        return view();
        */

}// fim da classe

?>
