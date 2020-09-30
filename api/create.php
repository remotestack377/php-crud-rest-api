<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/users.php';

    $database = new DB();
    $db = $database->getConnection();

    $item = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->email = $data->email;
    $item->age = $data->age;
    $item->profile = $data->profile;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->createUser()){
        echo 'User created.';
    } else{
        echo 'User was not created.';
    }
?>