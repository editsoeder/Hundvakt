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

        if (!empty($entry["first_name"]) || !empty($entry["last_name"]) || !empty($entry["email"]) || !empty($entry["password"]) || !empty($entry["location"]) || !empty($entry["cost"]) || !empty($entry["days"]) || !empty($entry["areas"])|| !empty($entry["extraInfo"])) {
            send(["message" => "You need to fill in all fields"], 400) ;
            exit();
        }

        if(is_null($entry) ){
            send(["message" => "Bad Request"], 400);
            exit();
        }
        
        if(strlen($entry["password"]) < 4) {
            send(["message" => "Password needs to be at least 4 characters"], 400) ;
            exit();
        }

        addEntry("../dogsitter/dogsitter.json", $entry);
        send(["Message" => "User created"], 200) ;
        exit();
        } else {
            send(["message"=>"Wrong content-type"], 400);
            exit();
        }
    } else {
        send(["message"=>"Wrong Method"], 405);
        exit();
    }


    // if( isMethod("POST") ){
    //     if( isType("application/json") ){
    //         $entry = json_decode(file_get_contents("php://input"),true);
    
    //         if(is_null($entry) ){
    //             sendJSON(["message" => "Bad Request"], 400);
    //             exit();
    //         }
    
    //         $fields = [
    //             "first_name", 
    //             "last_name", 
    //             "gender", 
    //             "email"
    //         ];
    
    //         if (  checkAllFields($fields, $entry) ) {
    
    //             sendJSON(["message"=>"Missing key"], 400);
    //             exit();
    //         }
    //         if( ! allFieldsSet($entry) ){
    //             sendJSON(["message"=>"All fields must be filled in"], 400);
    //             exit();
    //         }
    //         addEntry("$directory.json", $entry);
    //         sendJSON(["Message" => "Tenant created", "Apartment" => $entry], 200) ;
    //         exit();
    
    //     }else{
    //         sendJSON(["message"=>"Wrong content-type"], 400);
    //         exit();
    //     }
    // }else{
    //     sendJSON(["message"=>"Wrong Method"], 405);
    //     exit();
    // }
?> 