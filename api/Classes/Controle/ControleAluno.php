<?php

namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleAluno{

    private $modelo;

    public function __construct(Modelo\ModeloAluno $modelo){
        $this->modelo = $modelo;
    }



}// fim da classe

?>
