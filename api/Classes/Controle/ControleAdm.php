<?php

namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;
use RecomendaGrade\Visao;

class ControleAdm{

    private $modelo;

    public function __construct(Modelo\ModeloAluno $modelo){
        $this->modelo = $modelo;
    }

    public function salvar(){

        // primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

		$nomeAluno = $dados['nomeAluno'] ?? "";
		$email = $dados['email'] ?? 0;
		$senha= $dados['senhaHash'] ?? 0;
		$dataCadastro = date("Y-m-d");
		$tipo = 2;  // tipo coordenador

        $nomeCurso = $dados['nomeCurso'] ?? "";

        //validacao botao salvar
        if(!$nomeAluno || strlen($nomeAluno) > 60){
			header("HTTP/1.1 422 Unprocessable Entity: Nome do coordenador");
			die();
		}

        if(!$nomeCurso || strlen($nomeCurso) > 60){
			header("HTTP/1.1 422 Unprocessable Entity: Nome do curso");
			die();
		}

		if(!$senha || strlen($senha) == 0){
			header("HTTP/1.1 422 Unprocessable Entity: senha coordenador");
			die();
		}

        if(!$email || strlen($email) > 100){
			header("HTTP/1.1 422 Unprocessable Entity: email do coordenador");
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

		// criar um objeto aluno/coordenador
		$Coordenador = new Modelo\Aluno($nomeAluno, $email, $dataCadastro, $senhaHash, $tipo);
		$resultadoCoordenador = $this->modelo->salvar($Coordenador);



        //criar um objeto curso
        $nomePeriodos = "Periodo Provisório";
        $qtPeriodos = 1;
        $cargaMinima = 1;
        $publico = 0; //desabilitado
        $idCoordenador = $resultadoCoordenador['id'];
        $disciplinas=[] = null;

        $Curso = new Modelo\Curso($nomeCurso, $nomePeriodos, $qtPeriodos, $cargaMinima, $idCoordenador, $dataCadastro);
        $modeloCurso = new \RecomendaGrade\Modelo\ModeloCurso($this->conexao);
        $resultadoCurso = $modeloCurso->modelo->salvar($Curso);


        //adicionar o curso crido ao coordenador
        $ListaCursos[] = $resultadoCurso['id'];
        $resultado = $this->modelo->salvarCursosAluno($resultadoCoordenador, $ListaCursos);


        ///tem que retornar pra algum lugar (visao)
        $visao = new Visao\VisaoAluno($this->modelo);
        $visao->printarAluno($Coordenador);

		return $resultado;


    }//fim da funcao salvar


    
}// fim da classe

?>
