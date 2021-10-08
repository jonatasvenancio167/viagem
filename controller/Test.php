<?php
    header("Content-Type: application/json");

    $response = [];

    try{
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $headers = apache_request_headers();
            if(!isset($headers['auth'])){
                http_response_code(401);

                $response['message'] = 'Requisição invalida precisa do token';
            }

            //validar o token

            if(isset($_GET['list'])){
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!isset($_POST['nome'])){
                http_response_code(401);
                
                $response['message'] = 'Requisição invalida';
            }

            //validar o token
        }
    }catch(Exception $e){
        http_response_code(500);

        $response = ['message' => 'Erro', 'data' => $e->getMessage()];
    }

    die(json_encode($response))
?>