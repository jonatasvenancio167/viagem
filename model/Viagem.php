<?php

require_once 'EmpresaOnibus';
require_once 'CidadeDestino';

class Viagem{
    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $telefone;
    private $empresaOnibus;
    private $dataHora;
    private $cidadeDestino;

    public function __construct(){
        $this->empresaOnibus = new EmpresaOnibus();
        $this->cidadeDestino = new CidadeDestino();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of sobrenome
     */ 
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * Set the value of sobrenome
     *
     * @return  self
     */ 
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of empresaOnibus
     */ 
    public function getEmpresaOnibus()
    {
        return $this->empresaOnibus;
    }

    /**
     * Set the value of empresaOnibus
     *
     * @return  self
     */ 
    public function setEmpresaOnibus($empresaOnibus)
    {
        $this->empresaOnibus = $empresaOnibus;

        return $this;
    }

    /**
     * Get the value of dataHora
     */ 
    public function getDataHora()
    {
        return $this->dataHora->format('Y-m-d H:i:s');
    }

    /**
     * Set the value of dataHora
     *
     * @return  self
     */ 
    public function setDataHora(DateTime $dataHora)
    {
        $this->dataHora = new DateTime($dataHora);

        return $this;
    }

    /**
     * Get the value of cidadeDestino
     */ 
    public function getCidadeDestino()
    {
        return $this->cidadeDestino;
    }

    /**
     * Set the value of cidadeDestino
     *
     * @return  self
     */ 
    public function setCidadeDestino($cidadeDestino)
    {
        $this->cidadeDestino = $cidadeDestino;

        return $this;
    }
}

?>