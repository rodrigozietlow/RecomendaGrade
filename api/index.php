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

$rotasQuebradas = explode("/", $url['rota']);

$verbo = $_SERVER['REQUEST_METHOD'];


if(empty($rotasQuebradas)){
	// enviar erro
}
else{
	$rotaEscolhida = $rotas[$rotasQuebradas[0]] ?? "index";
	print_r($rotasQuebradas);
	echo "<br>";
	print_r($rotaEscolhida);
	// $modelo = new $rotaEscolhida["Modelo"]();
	// and so on
	if($verbo == "GET"){
		if(count($rotasQuebradas) >= 2) { // tem disciplina/id
			// executa $modelo->buscar($rotasQuebradas[1])
		}
	}
	else if($verbo == "POST"){
		// chamar os métodos de salvar e buscar os dados
	}
}
?>
