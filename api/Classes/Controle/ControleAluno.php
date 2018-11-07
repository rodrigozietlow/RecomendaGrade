<?php

namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleAluno{

    private $modelo;

    public function __construct(Modelo\ModeloAluno $modelo){
        $this->modelo = $modelo;
    }

    public function login($login, $senha){

        $acesso = $this->modelo->login($login, $senha);

        if($acesso == NULL){
            header("HTTP/1.1 401 Unauthorized");
            die();
        }

        return view();

}// fim da classe

?>
