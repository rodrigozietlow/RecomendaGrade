<?php
namespace RecomendaGrade;

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
		"Modelo" => "RecomendaGrade\\Modelo\\ModeloCurso",
		"Controle" => "",
		"Visao" => "RecomendaGrade\\Visao\\VisaoCurso"
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
	//print_r($rotasArray);
	//echo "<br>";
	//print_r($rotaEscolhida);

	// criar o modelo
	$pdo = new \PDO('mysql:host=localhost;dbname=recomendagrade', 'root', 'root');//PDO('mysql:host=localhost;dbname=test', $user, $pass);
	$modelo = new $rotaEscolhida["Modelo"]($pdo);

	// criar a visao
	$visao = new $rotaEscolhida["Visao"]($modelo);
	// and so on
	if($verbo == "GET"){
		if(count($rotasArray) >= 2) { // tem disciplina/id
			$visao->buscar($rotasArray[1]);
		}
		else{
			// $visao->listar();
		}
	}
	else if($verbo == "POST"){
		// chamar os métodos de salvar e buscar os dados
	}
}
?>
