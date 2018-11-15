<?php
namespace RecomendaGrade;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT, PATCH, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

session_start();


$aluno = new Modelo\Aluno("Rodrigo", "rodrigo.zietlow@teste.com", "2018-11-07", "aaaaaaaaaaaaaaa", 3);
$aluno->setId(2);
$_SESSION['aluno'] = $aluno;

//print_r($_SESSION);
