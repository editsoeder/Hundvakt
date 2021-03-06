<?php 
require_once __DIR__ . "/../functions.php";

// Ladda in vår JSON data från vår fil
$dogOwner = loadJson(__DIR__ . "/../API/dogowner_api.json");

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
    if (!isset($requestData["id_owner"])) {
        send(
            [
                "code" => 3,
                "message" => "Missing `id` of request body"
            ],
            400
        );
    }

    $id = $requestData["id_owner"];
    $found = false;
    $foundUser = null;

    foreach ($dogOwner as $index => $user) {

        //Om ID som skickas med finns i users.json
        if ($user["id_owner"] == $id) {
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

                // if (in_array($requestData["days"], $user["days"])) {
                //     $key = array_search($requestData["days"], $user["days"]);
                //     array_splice($user["days"], $key);

                // } else {
                //     array_push($user["days"], $requestData["days"]);
                //     array_push($dogSitter, $user["days"]);
                // }

                $user["days"] = $requestData["days"];
            }

            if (isset($requestData["dogName"])) {

                //om name är = 0 tecken
                if (strlen($requestData["dogName"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "dogName",
                                    "message" => "`name` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["dog"]["dogName"] = $requestData["dogName"];
            }

            if (isset($requestData["breed"])) {

                //om breed är = 0 tecken
                if (strlen($requestData["breed"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "breed",
                                    "message" => "`breed` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["dog"]["breed"] = $requestData["breed"];
            }

            if (isset($requestData["gender"])) {

                //om gender är = 0 tecken
                if (strlen($requestData["gender"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "gender",
                                    "message" => "`gender` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["dog"]["gender"] = $requestData["gender"];
            }

            if (isset($requestData["extraInfo"])) {

                //om extra är = 0 tecken
                if (strlen($requestData["extraInfo"]) == 0) {
                    send([
                        "code" => 401,
                        "message" => "Bad request, invalid format",
                        "errors" => [
                                [
                                    "field" => "extraInfo",
                                    "message" => "`extra` has to be more then 0 characters"
                                ]
                        ]
                    ]); 
                }

                $user["dog"]["extraInfo"] = $requestData["extraInfo"];
            }

            // Uppdatera vår array
            $dogOwner[$index] = $user;
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


    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("dogowner_api.json", "dogowner_backup_api.json");

    $dogOwnerJson = __DIR__ . "/../API/dogowner_api.json";
    saveJson($dogOwnerJson, $dogOwner);

    send($foundUser);

}

?>