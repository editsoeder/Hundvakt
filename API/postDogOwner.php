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

        if(validEmail($data, $entry["email"]) == true ) {
            send(["message" => "Email adress is already used"], 400) ;
            exit();
        }
        if (empty($entry["first_name"]) || empty($entry["last_name"]) || empty($entry["email"]) || empty($entry["password"]) || empty($entry["location"]) || empty($entry["cost"]) || empty($entry["days"]) || empty($entry["dog"]["dogName"])|| empty($entry["dog"]["breed"]) || empty($entry["dog"]["gender"]) || empty($entry["dog"]["extraInfo"])) {
            send(["message" => "You need to fill in all fields"], 400) ;
            exit();
        }

        if(strlen($entry["password"]) < 4) {
            send(["message" => "Password needs to be at least 4 characters"], 400) ;
            exit();
        }

        addEntry("../dogowner/dogowners.json", $entry);
        send(["message" => "Dowowner created"], 200) ;
        exit();
        } else {
            send(["message"=>"Wrong content-type"], 400);
            exit();
        }
    } else {
        send(["message"=>"Wrong Method"], 405);
        exit();
    }

    ?>