<?php
    require_once '../service/EmpresaOnibusService.php';
    require_once '../service/CidadeDestinoService.php';
    require_once '../service/ViagemService.php';
    require_once '../model/Viagem.php';

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
            // Viagem.php?data=2021-10-09

            if(isset($_GET['data'])){
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);//vai pegar o json body

            //valida se todos os campos estao sendo passados
            if(!isset($data['nome']) || trim($data['nome']) === '' || !isset($data['sobrenome']) || trim($data['sobrenome']) === '' || !isset($data['email']) || trim($data['email']) === '' || !isset($data['telefone']) || trim($data['telefone']) === '' || !isset($data['empresa_onibus']) || trim($data['empresa_onibus']) === '' || !isset($data['data']) || trim($data['data']) === '' || !isset($data['hora']) || trim($data['hora']) === '' || !isset($data['cidade_destino']) || trim($data['cidade_destino']) === '' ){
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

            date_default_timezone_set('America/Sao_Paulo');

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

            //valido se a cidade existe
            $cidadeDestinoService = new CidadeDestinoService();
            if(!$cidadeDestinoService->cidadeExiste($data['cidade_destino'])){
                http_response_code(401);
                
                $response['message'] = 'Cidade invalida';

                die(json_encode($response));
            }

            //validando o telefone somente pelo numeros
            $telefoneNumeros = preg_replace("/[^0-9]/", '', $data['telefone']);
            if (strlen($telefoneNumeros) < 11){
                http_response_code(401);
                
                $response['message'] = 'Telefone invalido';

                die(json_encode($response));
            }

            $empresaOnibus = new EmpresaOnibus();
            $empresaOnibus = $empresaOnibusService->getEmpresa($data['empresa_onibus']);

            $cidade = new CidadeDestino();
            $cidade = $cidadeDestinoService->getCidade($data['cidade_destino']);

            $viagem = new Viagem();
            $viagem->setNome($data['nome'])
                ->setSobrenome($data['sobrenome'])
                ->setEmail($data['email'])
                ->setTelefone($data['telefone'])
                ->setEmpresaOnibus($empresaOnibus)
                ->setDataHora($requestDate)
                ->setCidadeDestino($cidade)
            ;

            if(ViagemService::salvarViagem($viagem)){
                $response['message'] = 'Registro salvo com sucesso';
            }
        }
    }catch(Exception $e){
        http_response_code(500);

        $response = ['message' => 'Erro', 'data' => $e->getMessage()];
    }

    die(json_encode($response))
?>