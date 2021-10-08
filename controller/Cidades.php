<?php
    require "../model/CidadeDestino.php";
    require_once "../model/Connection.php";

    header("Content-Type: application/json");

    $response = [];

    try{
        $cidadeDestino = new CidadeDestino();
        $con = new Connection();

        $stmt = $con->getConnection()->prepare($cidadeDestino->getSelectSQL()); 
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $cidadeDestino->arrayToObject($row);

            $response[] = [
                'id' => $cidadeDestino->getId(),
                'nome' => $cidadeDestino->getNome(),
            ];
        }
    }catch(Exception $e){
        http_response_code(500);

        $response = ['message' => 'Erro', 'data' => $e->getMessage()];
    }

    die(json_encode($response))
?>