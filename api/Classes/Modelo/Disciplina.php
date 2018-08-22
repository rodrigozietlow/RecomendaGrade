<?php
namespace RecomendaGrade\Modelo;

class Disciplina {

	private $id;
	private $nome;
	private $periodo;
	private $creditos;
	private $cargaHoraria;
	private $idCurso;
	private $dataCadastro;

	public function __construct($nome, $periodo, $creditos, $cargaHoraria, $idCurso, $dataCadastro, $id=NULL){
		$this->id = $id;
		$this->nome = $nome;
		$this->periodo = $periodo;
		$this->creditos = $creditos;
		$this->cargaHoraria = $cargaHoraria;
		$this->idCurso = $idCurso;
		$this->dataCadastro = $dataCadastro;
	}

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Nome
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of Nome
     *
     * @param mixed nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of Periodo
     *
     * @return mixed
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set the value of Periodo
     *
     * @param mixed periodo
     *
     * @return self
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get the value of Creditos
     *
     * @return mixed
     */
    public function getCreditos()
    {
        return $this->creditos;
    }

    /**
     * Set the value of Creditos
     *
     * @param mixed creditos
     *
     * @return self
     */
    public function setCreditos($creditos)
    {
        $this->creditos = $creditos;

        return $this;
    }

    /**
     * Get the value of Carga Horaria
     *
     * @return mixed
     */
    public function getCargaHoraria()
    {
        return $this->cargaHoraria;
    }

    /**
     * Set the value of Carga Horaria
     *
     * @param mixed cargaHoraria
     *
     * @return self
     */
    public function setCargaHoraria($cargaHoraria)
    {
        $this->cargaHoraria = $cargaHoraria;

        return $this;
    }

    /**
     * Get the value of Id Curso
     *
     * @return mixed
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * Set the value of Id Curso
     *
     * @param mixed idCurso
     *
     * @return self
     */
    public function setIdCurso($idCurso)
    {
        $this->idCurso = $idCurso;

        return $this;
    }

    /**
     * Get the value of Data Cadastro
     *
     * @return mixed
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set the value of Data Cadastro
     *
     * @param mixed dataCadastro
     *
     * @return self
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

}
?>
