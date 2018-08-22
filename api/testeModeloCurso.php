<?php
namespace RecomendaGrade;

require 'vendor/autoload.php';

echo "<pre>";

$pdo = new \PDO('mysql:host=localhost;dbname=recomendagrade', 'root', 'root');//PDO('mysql:host=localhost;dbname=test', $user, $pass);

$modelo = new Modelo\ModeloCurso($pdo);
//$modeloDisciplinas = new Modelo\ModeloDisciplina($pdo);

//var_dump($modeloDisciplinas->buscarDisciplinasCurso(1));
var_dump($modelo->buscarCurso(1));


echo "</pre>";
?>
