<?php
	header("Content-Type: application/json");

    include_once 'Auth.php';
    $data = [];

    $fn = $_REQUEST['fn'];
    $id = $_REQUEST['id'] ?? 0;
    $login = $_REQUEST['login'] ?? null;
    $password = $_REQUEST['password'] ?? null;

    $person = new Person;
    $person->setId($id);

    // if($fn == "create" && $login !== null && &password !== null){
    //     $person->setlogin($login);
    //     $person->setlogin($password);
    //     $data["person"] = $person->create();
    // }

    if($fn == "read"){
        $data["person"] = $person->read();
    }

    die(json_encode($data));    
    
?>
