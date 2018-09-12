<?php
namespace RecomendaGrade;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

//echo "<pre>";

$pdo = new \PDO('mysql:host=localhost;dbname=recomendagrade', 'aluno', 'aluno');//PDO('mysql:host=localhost;dbname=test', $user, $pass);

$modelo = new Modelo\ModeloCurso($pdo);
//$modeloDisciplinas = new Modelo\ModeloDisciplina($pdo);

//var_dump($modeloDisciplinas->buscarDisciplinasCurso(1));
//var_dump($modelo->buscarCurso(1));

//var_dump($modelo->publicarCurso(1));

//echo "==============================================";

//$controle = new Controle\ControleCurso($modelo);

//$controle->editar();

$modelo->salvarCurso($curso);

//echo "</pre>";
?>
