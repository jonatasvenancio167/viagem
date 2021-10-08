<?php
    require "../model/EmpresaOnibus.php";
    require_once "../model/Connection.php";

    header("Content-Type: application/json");

    $response = [];

    try{
        $empresa = new EmpresaOnibus();
        $con = new Connection();

        $stmt = $con->getConnection()->prepare($empresa->getSelectSQL()); 
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $empresa->arrayToObject($row);

            $response[] = [
                'id' => $empresa->getId(),
                'nome' => $empresa->getNome(),
            ];
        }
    }catch(Exception $e){
        http_response_code(500);

        $response = ['message' => 'Erro', 'data' => $e->getMessage()];
    }

    die(json_encode($response))
?>