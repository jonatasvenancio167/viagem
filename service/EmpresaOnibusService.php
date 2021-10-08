<?php
require_once '../model/Connection.php';

class EmpresaOnibusService{
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
}

?>