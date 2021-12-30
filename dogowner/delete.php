<?php
session_start();

if (!isset($_SESSION["loggedInAsDogOwner"])) {
    if(isset($_SESSION["loggedInAsDogSitter"])) {
        header("Location: ../dogsitter/profile.php");
        exit();
    } else {
        header("Location: ../sign-in.php");
        exit();
    }
}

require_once __DIR__ . "/../functions.php";
error_reporting(-1);

//Remove länk till delete.php => <p><a href='delete.php?id={$specifikHund['id']}'>Remove</a></p>


if (isset($_SESSION["loggedInAsDogOwner"])) {
    $dogDeleteID = $_SESSION["loggedInAsDogOwner"];

    deleteDog($dogDeleteID);
}

//Radera hund från json filer
function deleteDog($dogID) {
    $data = json_decode(file_get_contents(__DIR__ . "/../dogowner/dogowners.json"), true);
    $found = false;

    foreach ($data as $key => $dogOwner) {
        if ($dogID == $dogOwner["id_owner"]) {
            $found = true;
            $index = $key;
            break;
        }
    }
    if ($found) {
        $data = json_decode(file_get_contents(__DIR__ . "/../dogowner/dogowners.json"), true);
        unset($data[$index]);
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "/../dogowner/dogowners.json", $json);
    }
    header("Location: index.php");
}


// Ladda in vår JSON data från vår fil, i detta fallet är det $users
$dogOwner = loadJson(__DIR__ . "/../dogowner/dogowners.json");

// Vilken HTTP metod vi tog emot
$method = $_SERVER["REQUEST_METHOD"];

// Hämta ut det som skickades till vår server
// $data = file_get_contents("php://input");
$requestData = json_decode($data, true);



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



    // Uppdaterar filen
    $dogOwnerJson =  __DIR__ . "/../dogowner/dogowners.json";
    saveJson($dogOwnerJson, $dogOwner);
    

?>