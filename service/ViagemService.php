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

    public function listarViagem($requestData = null){
        try{
            $date = null;

            $con = new Connection();
            $stmt = null;

            if($requestData){
                $dateStart = $requestData.' 00:00:00';
                $dateEnd = $requestData.' 23:59:59';

                $stmt = $con->getConnection()->prepare("
                    select 
                        viagem.id, viagem.nome, sobrenome, email, telefone, 
                        id_empresa_onibus, eo.nome as nome_empresa_onibus, data_hora,
                        id_cidade_destino,
                        cd.nome as nome_cidade_destino
                    FROM viagem 
                    inner join cidade_destino cd on (viagem.id_cidade_destino = cd.id)
                    inner join empresa_onibus eo on (viagem.id_empresa_onibus = eo.id) WHERE data_hora between ? and ?
                    order by viagem.id
                "); 

                $stmt->bind_param("ss", $dateStart, $dateEnd);
                $stmt->execute();
            }else{
                $stmt = $con->getConnection()->prepare("
                    select 
                        viagem.id, viagem.nome, sobrenome, email, telefone, 
                        id_empresa_onibus, eo.nome as nome_empresa_onibus, data_hora,
                        id_cidade_destino,
                        cd.nome as nome_cidade_destino
                    FROM viagem 
                    inner join cidade_destino cd on (viagem.id_cidade_destino = cd.id)
                    inner join empresa_onibus eo on (viagem.id_empresa_onibus = eo.id) WHERE data_hora
                    order by viagem.id
                "); 

                $stmt->execute();
            }
            
            $result = $stmt->get_result();
            
            $viagem = new Viagem();

            $response = [];
            
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $viagem->arrayToObject($row);

                $response[] = [
                    'id' => $viagem->getId(),
                    'nome' => $viagem->getNome(),
                    'sobrenome' => $viagem->getSobrenome(),
                    'email' => $viagem->getEmail(),
                    'telefone' => $viagem->getTelefone(),
                    'empresa_onibus' => [
                        'id' => $viagem->getEmpresaOnibus()->getId(),
                        'nome' => $viagem->getEmpresaOnibus()->getNome(),
                    ],
                    'data_hora' => $viagem->getDataHora(),
                    'cidade_destino' => [
                        'id' => $viagem->getCidadeDestino()->getId(),
                        'nome' => $viagem->getCidadeDestino()->getNome()
                    ]
                ];
            }

            die(json_encode($response));
        }catch(Throwable $e){
            throw $e;
        }
    }
}

?>