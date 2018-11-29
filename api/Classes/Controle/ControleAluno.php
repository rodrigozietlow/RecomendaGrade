<?php

namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;
use RecomendaGrade\Visao;

class ControleAluno{

    private $modelo;

    public function __construct(Modelo\ModeloAluno $modelo){
        $this->modelo = $modelo;
    }

    public function salvar(){

        // primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

		$nomeAluno = $dados['nomeAluno'] ?? "";
		$email = $dados['email'] ?? 0;
		$senha = $dados['senhaHash'] ?? 0;
		$dataCadastro = date("Y-m-d");
		$tipo = 3;
		$cursos = $dados['cursos'] ?? array();

        //validacao botao salvar
        if(!$nomeAluno || strlen($nomeAluno) > 60){
			header("HTTP/1.1 422 Unprocessable Entity: Nome da disciplina");
			die();
		}

        if(!$email || strlen($email) > 100){
			header("HTTP/1.1 422 Unprocessable Entity: Nome da disciplina");
			die();
		}


        if(count($cursos) == 0){
            header("HTTP/1.1 422 Unprocessable Entity");
            die();
        }


		// validacao do email
        $existeEmail = $this->modelo->validarEmail($email);

        if($existeEmail){
            header("HTTP/1.1 401 Unauthorized");
            die();
        }

		//criptografar senha
		$senhaHash = $this->modelo->criptografarSenha($senha);

		// criar um objeto aluno
		$Aluno = new Modelo\Aluno($nomeAluno, $email, $dataCadastro, $senhaHash, $tipo);

		$resultado = $this->modelo->salvar($Aluno);
		$resultado = $resultado && $this->modelo->salvarCursosAluno($Aluno, $cursos);


		if($resultado) {
			$_SESSION['aluno'] = $Aluno;
		}

		$visao = new Visao\VisaoAluno($this->modelo);
		$visao->printarAluno($Aluno);

		return $resultado;


    }//fim da funcao salvar


}// fim da classe

?>
