<?php
require_once '../model/Connection.php';
require_once '../model/CidadeDestino.php';

class CidadeDestinoService{
    private $city;

    public function cidadeExiste($idCidade) {
        try{
            $con = new Connection();
            
            $stmt = $con->getConnection()->prepare("select * FROM cidade_destino WHERE id = ?"); 

            $stmt->bind_param("i", $idCidade);
            $stmt->execute();
            $result = $stmt->get_result();
            $city = $result->fetch_assoc(); 
            
            if($city){
               return true; 
            }else{
                return false;
            }
        }catch(Throwable $e){
            throw $e;
        }
    }

    public function getCidade($idCidade) {
        try{
            $con = new Connection();
            $this->city = new CidadeDestino();
            
            $stmt = $con->getConnection()->prepare("select * FROM cidade_destino WHERE id = ?"); 

            $stmt->bind_param("i", $idCidade);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $this->city->arrayToObject($row);
            }

            return $this->city;
        }catch(Throwable $e){
            throw $e;
        }
    }
}

?>