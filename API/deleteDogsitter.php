<?php

require_once "../functions.php";
error_reporting(-1);


if (isset($_GET["id"])) {
    $dogDeleteID = $_GET["id"];

    deleteDog($dogDeleteID);
}

//Radera hund från db.json
function deleteDog($dogID) {
    $data = json_decode(file_get_contents("dogsitter_api.json"), true);
    $found = false;

    foreach ($data as $key => $dogSitter) {
        if ($dogID == $dogSitter["id_sitter"]) {
            $found = true;
            $index = $key;
            break;
        }
    }
    if ($found) {
        $data = json_decode(file_get_contents("dogsitter_api.json"), true);
        unset($data[$index]);
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("dogsitter_api.json", $json);
    }
    send(
        ["message" => "Dogsitter deleted"],
        200
    );
}


// Ladda in vår JSON data från vår fil, i detta fallet är det $users
$dogSitter = loadJson("dogsitter_api.json");

// Vilken HTTP metod vi tog emot
$method = $_SERVER["REQUEST_METHOD"];

// Hämta ut det som skickades till vår server
$data = file_get_contents("php://input");
$requestData = json_decode($data, true);

$contentType = $_SERVER["CONTENT_TYPE"];

// Content-Type: application/json; charset=utf-8; <- ibland skickas det i detta format
if ($contentType !== "application/json") {
    send(
        ["message" => "The API only accepts JSON"],
        415
    );
}

// Om det inte är DELETE
if ($method != "DELETE") {
    send(
        ["message" => "Method not allowed. Only 'DELETE' works."],
        405
    );
}

// Tar emot { id } och sedan raderar en användare baserat på id
if ($method === "DELETE") {

    // Kontrollera att vi har den datan vi behöver
    if (!isset($requestData["id_sitter"])) {
        send(
            [
                "code" => 1,
                "message" => "Missing `id` of request body"
            ],
            400
        );
    }

    // Kontrollera att id är en siffra
    $id = $requestData["id_sitter"];
    $found = false;

   // Om id existerar
   foreach ($dogSitter as $index => $user) {
    if ($user["id_sitter"] == $id) {
        $found = true;
        array_splice($dogSitter, $index, 1);
        break;
        }
    }

    // Om id inte existerar
    if ($found === false) {
        send(
            [
                "code" => 2,
                "message" => "The users by `id` does not exist"
            ],
            404
        );
    }

    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("dogsitter_api.json", "dogsitter_backup_api.json");
    // Uppdaterar filen
    $dogSitterJson = "dogsitter_api.json";
    saveJson($dogSitterJson, $dogSitter);
    send(
        ["You have deleted the following user" => $user],
        200
    );
}
?>