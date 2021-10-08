<?php
    require_once '../service/EmpresaOnibusService.php';

    header("Content-Type: application/json");

    $response = [];

    try{
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // $headers = apache_request_headers();
            // if(!isset($headers['auth'])){
            //     http_response_code(401);

            //     $response['message'] = 'Requisição invalida precisa do token';
            // }

            //validar o token

            if(isset($_GET['list'])){
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);//vai pegar o json body

            //valida se todos os campos estao sendo passados
            if(!isset($data['nome']) || $data['nome'] === '' || !isset($data['sobrenome']) || $data['sobrenome'] === '' || !isset($data['email']) || $data['email'] === '' || !isset($data['telefone']) || $data['telefone'] === '' || !isset($data['empresa_onibus']) || $data['empresa_onibus'] === '' || !isset($data['data']) || $data['data'] === '' || !isset($data['hora']) || $data['hora'] === '' || !isset($data['cidade_destino']) || $data['cidade_destino'] === '' ){
                http_response_code(401);
                
                $response['message'] = 'Requisição invalida';

                die(json_encode($response));
            }

            //valida email
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                http_response_code(401);
                
                $response['message'] = 'Email invalido';

                die(json_encode($response));
            }

            $requestDate = new DateTime($data['data'].' '.$data['hora']);

            //validacao da data
            if($requestDate < new DateTime('NOW')){
                http_response_code(401);
                
                $response['message'] = 'Data invalida';

                die(json_encode($response));
            }
            
            //valido se a empresa existe
            $empresaOnibusService = new EmpresaOnibusService();
            if(!$empresaOnibusService->empresaExiste($data['empresa_onibus'])){
                http_response_code(401);
                
                $response['message'] = 'Empresa de onibus invalida';

                die(json_encode($response));
            }

            

            $response['message'] = 'dando bom';
        }
    }catch(Exception $e){
        http_response_code(500);

        $response = ['message' => 'Erro', 'data' => $e->getMessage()];
    }

    die(json_encode($response))
?>