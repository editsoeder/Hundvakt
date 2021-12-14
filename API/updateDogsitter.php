<?php 

require_once "../functions.php";

// Ladda in vår JSON data från vår fil
$dogSitter = loadJson("dogsitter.json");

// Vilken HTTP metod vi tog emot
$method = $_SERVER["REQUEST_METHOD"];

// Hämta ut det som skickades till vår server
$data = file_get_contents("php://input");
$requestData = json_decode($data, true);

if ($method != "PATCH") {
    send(
        ["message" => "Method not allowed. Only 'PATCH' works."],
        405
    );
}

if ($method === "PATCH") {

    // Kontrollera att vi har den datan vi behöver
    if (!isset($requestData["id_sitter"])) {
        send(
            [
                "code" => 3,
                "message" => "Missing `id` of request body"
            ],
            400
        );
    }

    $id = $requestData["id_sitter"];
    $found = false;
    $foundUser = null;

    foreach ($dogSitter as $index => $user) {

        //Om ID som skickas med finns i users.json
        if ($user["id_sitter"] == $id) {
            $found = true;

            if (isset($requestData["first_name"])) {

                //om firstname är = 0 tecken
                if (strlen($requestData["first_name"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "first_name",
                                    "message" => "`first_name` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["first_name"] = $requestData["first_name"];
            }

            if (isset($requestData["last_name"])) {

                //om last_name är = 0 tecken
                if (strlen($requestData["last_name"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "last_name",
                                    "message" => "`last_name` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["last_name"] = $requestData["last_name"];
            }

            if (isset($requestData["email"])) {

                //om email är = 0 tecken
                if (strlen($requestData["email"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "email",
                                    "message" => "`email` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["email"] = $requestData["email"];
            }

            if (isset($requestData["password"])) {

                //om password är = 0 tecken
                if (strlen($requestData["password"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "password",
                                    "message" => "`password` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["password"] = $requestData["password"];
            }

            if (isset($requestData["cost"])) {

                //om cost är = 0 tecken
                if (strlen($requestData["cost"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "cost",
                                    "message" => "`cost` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["cost"] = $requestData["cost"];
            }

            if (isset($requestData["location"])) {

                //om location är = 0 tecken
                if (strlen($requestData["location"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "location",
                                    "message" => "`location` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["location"] = $requestData["location"];
            }

            if (isset($requestData["extra_info"])) {

                //om extra_info är = 0 tecken
                if (strlen($requestData["extra_info"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "extra_info",
                                    "message" => "`extra_info` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["extra_info"] = $requestData["extra_info"];
            }

            if (isset($requestData["areas"])) {

                //om areas är = 0 tecken
                if (strlen($requestData["areas"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "areas",
                                    "message" => "`areas` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                if (in_array($requestData["areas"], $user["areas"])) {
                    $key = array_search($requestData["areas"], $user["areas"]);
                    array_splice($user["areas"], $key);

                } else {
                    array_push($user["areas"], $requestData["areas"]);
                    array_push($dogSitter, $user["areas"]);
                } 

            }

            if (isset($requestData["days"])) {

                //om days är = 0 tecken
                if (strlen($requestData["days"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "days",
                                    "message" => "`days` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                if (in_array($requestData["days"], $user["days"])) {
                    $key = array_search($requestData["days"], $user["days"]);
                    array_splice($user["days"], $key);

                } else {
                    array_push($user["days"], $requestData["days"]);
                    array_push($dogSitter, $user["days"]);
                } 

            }

            // Uppdatera vår array
            $dogSitter[$index] = $user;
            $foundUser = $user;
            break;
        }
    }

    if ($found === false) {
        send(
            [
                "code" => 5,
                "message" => "The users by `id` does not exist"
            ],
            404
        );
    }

    saveJson("dogsitter.json", $dogSitter);
    send($foundUser);
}

?>