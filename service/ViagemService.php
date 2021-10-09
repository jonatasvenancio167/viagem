<?php
require_once '../model/Connection.php';
require_once '../model/Viagem.php';

abstract class ViagemService{
    public function salvarViagem(Viagem $viagem) {
        try{
            $con = new Connection();
            
            $string = 'INSERT INTO viagem (`nome`, `sobrenome`, `email`, `telefone`, `id_empresa_onibus`, `data_hora` , `id_cidade_destino`) VALUES (?,?,?,?,?,?,?)';

            $stmt = $con->getConnection()->prepare($string);
            $stmt->bind_param("ssssisi", $viagem->getNome(), $viagem->getSobrenome(), $viagem->getEmail(), $viagem->getTelefone(), $viagem->getEmpresaOnibus()->getId(), $viagem->getDataHora(), $viagem->getCidadeDestino()->getId());

            if( $stmt->execute() == TRUE){
                return true;
            }
        }catch(Throwable $e){
            throw $e;
        }
    }
}

?>