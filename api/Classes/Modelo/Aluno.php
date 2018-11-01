<?php

namespace RecomendaGrade;


class Aluno
{
    private $id;
    private $matricula;
    private $nomeAluno;
    private $email;
    private $login;
    private $dataCadastro;
    private $senha;
    private $tipo;

    function __construct(){}

    function __construct($nomeAluno, $matricula, $email, $login, $dataCadastro, $senha, $tipo)
    {
        $this->id = $id;
        $this->nomeAluno = $nomeAluno;
        $this->matricula = $matricula;
        $this->$email = $email;
        $this->login = $login;
        $this->dataCadastro = $dataCadastro;
        $this->senha = $senha;
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
     * Get the value of Matricula
     *
     * @return mixed
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set the value of Matricula
     *
     * @param mixed matricula
     *
     * @return self
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

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
     * Get the value of Login
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of Login
     *
     * @param mixed login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

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
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of Senha
     *
     * @param mixed senha
     *
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

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

}//fim da classe
