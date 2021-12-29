<?php

require_once __DIR__ . "/../functions.php";
error_reporting(-1);
session_start();

//Remove länk till delete.php => <p><a href='delete.php?id={$specifikHund['id']}'>Remove</a></p>

$allDogOwner = getAllDogOwner();


// if (isset($_SESSION["loggedInAsDogOwner"])) {
//     deleteDog($_SESSION["loggedInAsDogOwner"]);
// } 
// elseif (!isset($_SESSION["loggedInAsDogOwner"])) {
    
//     // header("Location: /admin/sign-out.php");
//     header("Location: ../sign.out.php");
//     exit();
// }


//Radera hund från json filer
// function deleteDog($ID) {
//     $data = json_decode(file_get_contents("dogowners.json"), true);

//     $found = false;
//     foreach ($data as $key => $user) {
//         if ($ID == $user["id_owner"]) {
//             $found = true;
//             $index = $key;
//             break;
//         }
//     }

//     if ($found) {
//         $data = json_decode(file_get_contents("dogowners.json"), true);
//         unset($data[$index]);
//         $json = json_encode($data, JSON_PRETTY_PRINT);
//         file_put_contents("dogowners.json", $json);
//     }
//     // header("Location: ../sign-out.php");
//     header("Location: profile.php");
// }

// Vilken HTTP metod vi tog emot
$method = $_SERVER["REQUEST_METHOD"];

// Hämta ut det som skickades till vår server
$data = file_get_contents("php://input");
$requestData = json_decode($data, true);


if ($method === "DELETE") {

    // Kontrollera att id är en siffra
    $id = $requestData["id_owner"];
    $found = false;

   // Om id existerar
   foreach ($allDogOwner as $index => $user) {
    if ($user["id_owner"] == $id) {
        $found = true;
        array_splice($allDogOwner, $index, 1);
        break;
        }
    }

    // Om id inte existerar
    if ($found === false) {
        echo "The users by `id` does not exist";
    }

    // Uppdaterar filen
    $dogOwnerJson = "dogowners.json";
    saveJson($dogOwnerJson, $allDogOwner);
    echo "You have deleted the following user";
}