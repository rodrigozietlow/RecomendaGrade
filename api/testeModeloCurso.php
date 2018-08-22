<?php
namespace RecomendaGrade;

require 'vendor/autoload.php';

echo "<pre>";

$pdo = new \PDO('mysql:host=192.168.103.223:5432;dbname=recomendagrade', 'aluno', 'aluno');//PDO('mysql:host=localhost;dbname=test', $user, $pass);

$modelo = new Modelo\ModeloCurso($pdo);

var_dump($modelo->buscarCurso(1));


echo "</pre>";
?>
