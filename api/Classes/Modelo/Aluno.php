<?php

namespace RecomendaGrade\Modelo;


class Aluno
{
    private $id;
    private $nomeAluno;
    private $email;
    private $dataCadastro;
    private $senhaHash;
    private $tipo;

    function __construct($nomeAluno, $email, $dataCadastro, $senhaHash, $tipo, $id=NULL)
    {
        $this->id = $id;
        $this->nomeAluno = $nomeAluno;
        $this->email = $email;
        $this->dataCadastro = $dataCadastro;
        $this->senhaHash = $senhaHash;
        $this->tipo = $tipo;  // 1=ADM     2=Coordenador     3=Aluno
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
     * Get the value of Nome Aluno
     *
     * @return mixed
     */
    public function getNomeAluno()
    {
        return $this->nomeAluno;
    }

    /**
     * Set the value of Nome Aluno
     *
     * @param mixed nomeAluno
     *
     * @return self
     */
    public function setNomeAluno($nomeAluno)
    {
        $this->nomeAluno = $nomeAluno;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

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
     * Get the value of Senha
     *
     * @return mixed
     */
    public function getSenhaHash()
    {
        return $this->senhaHash;
    }

    /**
     * Set the value of Senha
     *
     * @param mixed senha
     *
     * @return self
     */
    public function setSenhaHash($senhaHash)
    {
        $this->senhaHash = $senhaHash;

        return $this;
    }

    /**
     * Get the value of Tipo
     *
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of Tipo
     *
     * @param mixed tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
	public function getCursos()
    {
        return $this->cursos;
    }

    /**
     * Set the value of Cursos
     *
     * @param mixed cursos
     *
     * @return self
     */
    public function setCursos($cursos)
    {
        $this->cursos = $cursos;

        return $this;
    }

}//fim da classe
