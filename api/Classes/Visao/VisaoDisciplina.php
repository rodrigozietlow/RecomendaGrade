<?php

namespace RecomendaGrade\Visao;

class VisaoDisciplina {

	private $modelo;

	public function __construct(\RecomendaGrade\Modelo\ModeloDisciplina $modelo){
		$this->modelo = $modelo;
	}
	
}
?>
