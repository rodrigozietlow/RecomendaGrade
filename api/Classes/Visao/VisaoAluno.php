<?php

namespace RecomendaGrade\Visao;

class VisaoAluno {

	private $modelo;

	public function __construct(\RecomendaGrade\Modelo\ModeloAluno $modelo){
		$this->modelo = $modelo;
	}

}
?>
