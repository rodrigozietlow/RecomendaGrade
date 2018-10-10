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

$modelo = new Modelo\ModeloDisciplina($pdo);

$controle = new Controle\ControleDisciplina($modelo);
?>
