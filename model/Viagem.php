<?php

require_once 'EmpresaOnibus.php';
require_once 'CidadeDestino.php';

class Viagem{
    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $telefone;
    private $empresaOnibus;
    private $dataHora;
    private $cidadeDestino;

    public function arrayToObject($data){
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->sobrenome = $data['sobrenome'];
        $this->email = $data['email'];
        $this->telefone = $data['telefone'];

        $empresaOnibus = new EmpresaOnibus();
        $empresaOnibus
            ->setId($data['id_empresa_onibus'])
            ->setNome($data['nome_empresa_onibus'])    
        ;
        $this->empresaOnibus = $empresaOnibus;

        $this->dataHora = new DateTime($data['data_hora']);

        $cidadeDestino = new CidadeDestino();
        $cidadeDestino
            ->setId($data['id_cidade_destino'])
            ->setNome($data['nome_cidade_destino'])
        ;

        $this->cidadeDestino = $cidadeDestino;
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
    public function setEmpresaOnibus(EmpresaOnibus $empresaOnibus)
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
        $this->dataHora = $dataHora;

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
    public function setCidadeDestino(CidadeDestino $cidadeDestino)
    {
        $this->cidadeDestino = $cidadeDestino;

        return $this;
    }
}

?>