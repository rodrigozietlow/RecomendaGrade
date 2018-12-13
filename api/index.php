<?php
namespace RecomendaGrade;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

session_start();

// permitir chamadas
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT, PATCH, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

/*
$cores = array(
	"#FFC312", "#C4E538", "#12CBC4", "#FDA7DF",
	"#ED4C67", "#EE5A24", "#A3CB38", "#1289A7",
	"#D980FA", "#B53471", "#009432", "#0652DD",
	"#9980FA", "#833471", "#EA2027", "#006266",
	"#1B1464", "#5758BB", "#6F1E51"
);
*/

$url = $_GET;

// rotas estáticas:: podem ser mudadas no futuro
$rotas = array(
	"disciplina" => array(
		"Modelo" => "RecomendaGrade\\Modelo\\ModeloDisciplina",
		"Controle" => "RecomendaGrade\\Controle\\ControleDisciplina",
		"Visao" => "RecomendaGrade\\Visao\\VisaoDisciplina",
	),
	"curso" => array(
		"Modelo" => "RecomendaGrade\\Modelo\\ModeloCurso",
		"Controle" => "RecomendaGrade\\Controle\\ControleCurso",
		"Visao" => "RecomendaGrade\\Visao\\VisaoCurso"
	),
	"curso-todos" => array(
		"Modelo" => "RecomendaGrade\\Modelo\\ModeloCurso",
		"Controle" => "",
		"Visao" => "RecomendaGrade\\Visao\\VisaoCursoTodos"
	),
	"aluno" => array(
		"Modelo" => "RecomendaGrade\\Modelo\\ModeloAluno",
		"Controle" => "RecomendaGrade\\Controle\\ControleAluno",
		"Visao" => "RecomendaGrade\\Visao\\VisaoAluno"
	),
	"login" => array(
		"Modelo" => "RecomendaGrade\\Modelo\\ModeloAluno",
		"Controle" => "RecomendaGrade\\Controle\\ControleLogin",
		"Visao" => ""
	),
	"disciplinas-aluno" => array(
		"Modelo" => "RecomendaGrade\\Modelo\\ModeloDisciplina",
		"Controle" => "RecomendaGrade\\Controle\\ControleDisciplinaAluno",
		"Visao" => ""
	)
);

$rotasArray = array_filter(explode("/", $url['rota']));

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
	$pdo = new \PDO('mysql:host=localhost;dbname=recomendagrade', 'aluno', 'aluno');//PDO('mysql:host=localhost;dbname=test', $user, $pass);
	$modelo = new $rotaEscolhida["Modelo"]($pdo);

	// criar a visao
	if(!empty($rotaEscolhida["Visao"])){
		$visao = new $rotaEscolhida["Visao"]($modelo);
	}
	// and so on
	if($verbo == "GET"){
		if(count($rotasArray) >= 2) { // tem curso/id
			$visao->buscar($rotasArray[1]);
		}
		else{
			 $visao->listar();
		}
	}
	else if($verbo == "POST"){
		$controle = new $rotaEscolhida['Controle']($modelo);
		if(!$controle->salvar()){
			header("HTTP/1.1 500 Internal Server Error");
			die();
		}
	}
	else if($verbo == "PUT"){
		$controle = new $rotaEscolhida["Controle"]($modelo);
		if(!$controle->editar($rotasArray[1])){
			header("HTTP/1.1 500 Internal Server Error");
			die();
		}
	}

	else if($verbo == "DELETE"){
		$controle = new $rotaEscolhida['Controle']($modelo);
		if(!$controle->excluir($rotasArray[1])){
			header("HTTP/1.1 500 Internal Server Error");
			die();
		}
	}
}
?>
