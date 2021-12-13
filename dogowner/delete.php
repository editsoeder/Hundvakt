<?php

error_reporting(-1);

//Remove länk till delete.php => <p><a href='delete.php?id={$specifikHund['id']}'>Remove</a></p>


if (isset($_GET["id"])) {
    $dogDeleteID = $_GET["id"];

    deleteDog($dogDeleteID);
}

//Radera hund från db.json
function deleteDog($dogID) {
    $data = json_decode(file_get_contents("dogowners.json"), true);
    $found = false;

    foreach ($data as $key => $dogOwner) {
        if ($dogID == $dogOwner["id_owner"]) {
            $found = true;
            $index = $key;
            break;
        }
    }
    if ($found) {
        $data = json_decode(file_get_contents("dogowners.json"), true);
        unset($data[$index]);
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("dogowners.json", $json);
    }
    header("Location: index.php");
}


// Ladda in vår JSON data från vår fil, i detta fallet är det $users
$dogOwner = loadJson("dogowners.json");

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
        400
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
    if (!isset($requestData["id_owner"])) {
        send(
            [
                "code" => 1,
                "message" => "Missing `id` of request body"
            ],
            400
        );
    }

    // Kontrollera att id är en siffra
    $id = $requestData["id_owner"];
    $found = false;

   // Om id existerar
   foreach ($dogOwner as $index => $user) {
    if ($user["id_owner"] == $id) {
        $found = true;
        array_splice($dogOwner, $index, 1);
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

    // Uppdaterar filen
    $dogOwnerJson = "dogowners.json";
    saveJson($dogOwnerJson, $dogOwner);
    send(
        ["You have deleted the following user" => $user],
        200
    );
}
?>