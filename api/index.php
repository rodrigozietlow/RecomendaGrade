<?php
require 'vendor/autoload.php';

$url = $_GET;

// rotas estáticas:: podem ser mudadas no futuro
$rotas = array(
	"disciplina" => array( // é um exemplo pra mostrar como funciona o roteamento
		"Modelo" => "ModeloDisciplina",
		"Controle" => "ControleDisciplina",
		"Visao" => "VisaoDisciplina"
	),
	"curso" => array(
		"Modelo" => "ModeloCurso",
		"Controle" => "ControleCurso",
		"Visao" => "VisaoCurso"
	),
	"index" => array()
);

$rotasArray = explode("/", $url['rota']);

$verbo = $_SERVER['REQUEST_METHOD'];


if(empty($rotasArray)){
	// enviar erro
}
else{
	$rotaEscolhida = $rotas[$rotasArray[0]] ?? "index";
	print_r($rotasArray);
	echo "<br>";
	print_r($rotaEscolhida);
	// $modelo = new $rotaEscolhida["Modelo"]();
	// and so on
	if($verbo == "GET"){
		if(count($rotasArray) >= 2) { // tem disciplina/id
			// executa $modelo->buscar($rotasQuebradas[1])
		}
		else{
			// executa $modelo->listar
		}
	}
	else if($verbo == "POST"){
		// chamar os métodos de salvar e buscar os dados
	}
}
?>
