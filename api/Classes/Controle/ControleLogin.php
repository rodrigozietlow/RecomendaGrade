<?php
namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;
use RecomendaGrade\Visao;

class ControleLogin{

    private $modelo;

    public function __construct(Modelo\ModeloAluno $modelo){
        $this->modelo = $modelo;
    }

    public function salvar(){

        // primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

        $resultado = $this->modelo->login($dados['email'], $dados['senha']);
		if(!$resultado) {
			header("HTTP/1.1 401 Unauthorized");
            die();
		}

		// fizemos login com sucesso
		$_SESSION['aluno'] = $resultado;

		// print_r($resultado);

		$visao = new Visao\VisaoAluno($this->modelo);
		$visao->printarAluno($resultado);

        return true; // pra não jogar erro 500
    }

	public function excluir($sessao) {
		unset($_SESSION['usuario']);
		return true;
	}
}

?>
