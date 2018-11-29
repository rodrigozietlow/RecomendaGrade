<?php
namespace RecomendaGrade\Controle;
use RecomendaGrade\Modelo;

class ControleDisciplinaAluno{

    private $modelo;

    public function __construct(Modelo\ModeloDisciplina $modelo){
        $this->modelo = $modelo;
    }

    public function salvar(){

        // primero, precisamos pegar os dados que vem por stream
		$dados = json_decode(file_get_contents("php://input"), true);

		$idDisciplina = $dados['idDisciplina'];

		return $this->modelo->inserirCursada($idDisciplina);


        return true; // pra não jogar erro 500
    }

	public function excluir($idDisciplina) {
		return $this->modelo->excluirCursada($idDisciplina);
	}
}

?>
