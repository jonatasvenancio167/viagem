<?php
require_once '../model/Connection.php';
require_once '../model/EmpresaOnibus.php';

class EmpresaOnibusService{
    private $company;

    public function empresaExiste($idEmpresa) {
        try{
            $con = new Connection();
            
            $stmt = $con->getConnection()->prepare("select * FROM empresa_onibus WHERE id = ?"); 

            $stmt->bind_param("i", $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            $company = $result->fetch_assoc(); 
            
            if($company){
               return true; 
            }else{
                return false;
            }
        }catch(Throwable $e){
            throw $e;
        }
    }

    public function getEmpresa($idEmpresa) {
        try{
            $con = new Connection();
            $this->company = new EmpresaOnibus();
            
            $stmt = $con->getConnection()->prepare("select * FROM empresa_onibus WHERE id = ?"); 

            $stmt->bind_param("i", $idEmpresa);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $this->company->arrayToObject($row);
            }

            return $this->company;
        }catch(Throwable $e){
            throw $e;
        }
    }
}

?>