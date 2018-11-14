<?php
namespace RecomendaGrade;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

session_start();

$aluno = new Modelo\Aluno("Rodrigo", "201613330146", "rodrigo.zietlow@teste.com", "rodrigo", "2018-11-07", "aaaaaaaaaaaaaaa", 3);
$aluno->setId(2);
$_SESSION['aluno'] = $aluno;

//print_r($_SESSION);
