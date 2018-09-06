<?php

namespace RecomendaGrade\Modelo;

class Curso {
	private $id;
	private $nomeCurso;
	private $nomePeriodos;
	private $qtPeriodos;
	private $cargaMinima;
	private $idCoordenador;
	private $publico;
	private $dataCadastro;
	private $disciplinas;

	public function __construct($nomeCurso, $nomePeriodos, $qtPeriodos, $cargaMinima, $idCoordenador, $publico, $dataCadastro, $disciplinas=[], $id=NULL){
		$this->id = $id;
		$this->nomeCurso = $nomeCurso;
		$this->nomePeriodos = $nomePeriodos;
		$this->qtPeriodos = $qtPeriodos;
		$this->cargaMinima = $cargaMinima;
		$this->idCoordenador = $idCoordenador;
		$this->publico = $publico;
		$this->dataCadastro = $dataCadastro;
		$this->disciplinas = $disciplinas;
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
     * Get the value of Nome Curso
     *
     * @return mixed
     */
    public function getNomeCurso()
    {
        return $this->nomeCurso;
    }

    /**
     * Set the value of Nome Curso
     *
     * @param mixed nomeCurso
     *
     * @return self
     */
    public function setNomeCurso($nomeCurso)
    {
        $this->nomeCurso = $nomeCurso;

        return $this;
    }

    /**
     * Get the value of Nome Periodos
     *
     * @return mixed
     */
    public function getNomePeriodos()
    {
        return $this->nomePeriodos;
    }

    /**
     * Set the value of Nome Periodos
     *
     * @param mixed nomePeriodos
     *
     * @return self
     */
    public function setNomePeriodos($nomePeriodos)
    {
        $this->nomePeriodos = $nomePeriodos;

        return $this;
    }

    /**
     * Get the value of Qt Periodos
     *
     * @return mixed
     */
    public function getQtPeriodos()
    {
        return $this->qtPeriodos;
    }

    /**
     * Set the value of Qt Periodos
     *
     * @param mixed qtPeriodos
     *
     * @return self
     */
    public function setQtPeriodos($qtPeriodos)
    {
        $this->qtPeriodos = $qtPeriodos;

        return $this;
    }

    /**
     * Get the value of Carga Minima
     *
     * @return mixed
     */
    public function getCargaMinima()
    {
        return $this->cargaMinima;
    }

    /**
     * Set the value of Carga Minima
     *
     * @param mixed cargaMinima
     *
     * @return self
     */
    public function setCargaMinima($cargaMinima)
    {
        $this->cargaMinima = $cargaMinima;

        return $this;
    }

    /**
     * Get the value of Id Coordenador
     *
     * @return mixed
     */
    public function getIdCoordenador()
    {
        return $this->idCoordenador;
    }

    /**
     * Set the value of Id Coordenador
     *
     * @param mixed idCoordenador
     *
     * @return self
     */
    public function setIdCoordenador($idCoordenador)
    {
        $this->idCoordenador = $idCoordenador;

        return $this;
    }

    /**
     * Get the value of Publico
     *
     * @return mixed
     */
    public function getPublico()
    {
        return $this->publico;
    }

    /**
     * Set the value of Publico
     *
     * @param mixed publico
     *
     * @return self
     */
    public function setPublico($publico)
    {
        $this->publico = $publico;

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

    /**
     * Get the value of Disciplinas
     *
     * @return mixed
     */
    public function getDisciplinas()
    {
        return $this->disciplinas;
    }

    /**
     * Set the value of Disciplinas
     *
     * @param mixed disciplinas
     *
     * @return self
     */
    public function setDisciplinas($disciplinas)
    {
        $this->disciplinas = $disciplinas;

        return $this;
    }

}
