<?php


if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON("dogsitter.json");

    $newEntry = [ 
        "id_sitter" => getMaxID($data, "id_sitter") + 1,
        "first_name" => utf8_encode($_POST["firstName"]),
        "last_name" => $_POST["lastName"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "location" => $_POST["Placering"],
        "cost" => $_POST["Timkostnad"],
        "days" => $_POST["days"],
        "areas" => $_POST["areas"],
        "extraInfo" => $_POST["extraInfo"],
        "image" => $_POST["imageToUpload"]
    ];    
        if(is_null($newEntry) ){
            send(["message" => "Bad Request"], 400);
            exit();
        }
        
        addEntry("dogsitter.json", $newEntry);
        send(["Message" => "User created"], 200) ;
        exit();

} else{
    // send(["message"=>"Wrong Method"], 405);
    exit();
 
}
require_once "../section/footer.php";

if(isMethod("POST") ){
    if( isType("application/json") ){
        $entry = json_decode(file_get_contents("php://input"),true);

        if(is_null($entry) ){
            send(["message" => "Bad Request"], 400);
            exit();
        }

        $fields = [
            "firstName", 
            "lastName", 
            "gender", 
            "email"
        ];

        if (checkAllFields($fields, $entry) ) {

            send(["message"=>"Missing key"], 400);
            exit();
        }
        if( ! allFieldsSet($entry) ){
            send(["message"=>"All fields must be filled in"], 400);
            exit();
        }
        addEntry("$directory.json", $entry);
        send(["Message" => "Tenant created", "Apartment" => $entry], 200) ;
        exit();

    }else{
        send(["message"=>"Wrong content-type"], 400);
        exit();
    }
}else{
    send(["message"=>"Wrong Method"], 405);
    exit();
}


?> 