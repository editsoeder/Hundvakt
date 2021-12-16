<?php
require_once "../functions.php";

if($_SERVER["REQUEST_METHOD"] == "POST" ){    
    $data = loadJSON("../dogsitter/dogsitter.json");
    if($_SERVER["CONTENT_TYPE"] == "application/json" ){
        $userInput = json_decode(file_get_contents("php://input"),true);

        $entry = [
            "id_sitter" => getMaxID($data, "id_sitter") + 1, 
            "first_name" => $userInput["first_name"],
            "last_name" => $userInput["last_name"],  
            "email" => $userInput["email"], 
            "password" => $userInput["password"], 
            "location" => $userInput["location"], 
            "cost" => $userInput["cost"], 
            "days" => $userInput["days"], 
            "areas" => $userInput["areas"],
            "extraInfo" => $userInput["extraInfo"]
        ];
        
    addEntry("../dogsitter/dogsitter.json", $entry);
    send(["Message" => "User created"], 200) ;
    exit();
        }
    }
?> 