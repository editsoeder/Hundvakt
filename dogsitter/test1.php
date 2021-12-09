<?php
include "../functions.php";

function sendJSON($message, $statusCode) {

    header("Content-Type: application/json");
    http_response_code($statusCode);
    $jsonMessage = json_encode($message);

    echo($jsonMessage);
    exit();
}


function addEntry ($filename, $entry) {
    $data = getJSON($filename);
    array_push($data, $entry);
    saveToFile($filename, $data);
}


if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $newEntry = [ 
        "first_name" => $_POST["firstName"],
        "last_name" => $_POST["lastName"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "location" => $_POST["Placering"],
        "cost" => $_POST["Timkostnad"],
        "days" => $_POST["days"],
        "areas" => $_POST["areas"],
        "extraInfo" => $_POST["extraInfo"]
    ];    
        if(is_null($newEntry) ){
            sendJSON(["message" => "Bad Request"], 400);
            exit();
        }

        addEntry("dogsitter.json", $newEntry);
        sendJSON(["Message" => "User created"], 200) ;
        exit();
} else{
    sendJSON(["message"=>"Wrong Method"], 405);
    exit();
}


?>