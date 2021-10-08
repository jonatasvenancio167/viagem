<?php

class EmpresaOnibus {
    private $id;
    private $nome;

    public function arrayToObject($data){
        if(isset($data['id'])){
            $this->id = $data['id'];
        }

        if(isset($data['nome'])){
            $this->nome = $data['nome'];
        }
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

    public function getSelectSQL(){
        return 'select * from trabalho.empresa_onibus';
    }
}

?>