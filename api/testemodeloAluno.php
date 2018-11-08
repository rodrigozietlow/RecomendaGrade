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

$modelo = new Modelo\ModeloAluno($pdo);

$test = $modelo->login("luzinha", "aluno2");

if($test){
    print("voce logou");
}else{
    print("login incorreto");
}

$hashed_password = password_hash("teste", PASSWORD_DEFAULT);
var_dump($hashed_password);
?>
