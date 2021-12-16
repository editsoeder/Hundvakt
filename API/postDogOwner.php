<?php
require_once "../functions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST" ){    
        $data = loadJSON("../dogowner/dogowners.json");
        if($_SERVER["CONTENT_TYPE"] == "application/json" ){
            $userInput = json_decode(file_get_contents("php://input"),true);
            $entry = [ 
                "id_owner" => getMaxID($data, "id_owner") + 1, 
                "first_name" => $userInput["first_name"],
                "last_name" => $userInput["last_name"],  
                "email" => $userInput["email"], 
                "password" => $userInput["password"], 
                "location" => $userInput["location"], 
                "cost" => $userInput["cost"], 
                "days" => $userInput["days"], 
                "dog" => [
                    "dogName" => $userInput["dog"]["dogName"], 
                    "breed" => $userInput["dog"]["breed"], 
                    "gender" => $userInput["dog"]["gender"],
                    "extraInfo" => $userInput["dog"]["extraInfo"]
                ]
            ];    
        addEntry("../dogowner/dogowners.json", $entry);
        send(["Message" => "Dowowner created"], 200) ;
        exit();
            }
        }?>