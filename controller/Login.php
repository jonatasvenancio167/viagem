<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    
    require_once "../model/Connection.php";

    $response = [];

    try{
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /*exemplo de requisição
            {
                "login": "a",
                "password": "b"
            }
            */
            $data = json_decode(file_get_contents('php://input'), true);//vai pegar o json body

            if(!isset($data['login']) || !isset($data['password']) || $data['login'] === '' || $data['password'] === '' ){
                http_response_code(401);
                $response['message'] = 'Requisição invalida';
            }

            $con = new Connection();
            
            $stmt = $con->getConnection()->prepare("select * FROM auth WHERE user = ? and password = ?"); 
            //tipos string -> s
            $stmt->bind_param("ss", $data['login'], $data['password']);
            $stmt->execute();
            $result = $stmt->get_result(); // get the mysqli result
            $user = $result->fetch_assoc(); // fetch data   
            
            if(!$user){
                http_response_code(404);
                $response['message'] = 'Usuário nao encontrado';
            }else{
                http_response_code(200);

                date_default_timezone_set('America/Sao_Paulo');

                $date = new DateTime;
                $exp = $date->add(new DateInterval('PT15M'));//15 minutos de validade
                
                $dados = [
                    'user' => $data['login'],
                    'exp' => $exp->format('Y-m-d H:i:s'),
                    'rnd' => md5($data['login'].' '.$exp->format('Y-m-d H:i:s'))
                ];

                $response['token'] = base64_encode(json_encode($dados));
            }
        }
    }catch(Exception $e){

        http_response_code(500);

        $response = ['message' => 'Erro', 'data' => json_encode($e)];
    }

    die(json_encode($response))
?>
