<?php
require_once __DIR__ . "/../functions.php";
error_reporting(-1);
session_start();


if (isset($_SESSION["loggedInAsDogSitter"])) {
    deleteDog($_SESSION["loggedInAsDogSitter"]);
} 

elseif (!isset($_SESSION["loggedInAsDogSitter"])) {
    header("Location: ../sign.out.php");
    exit();
}


//Radera användare från json filen
function deleteDog($ID) {

    $allDogSitter = getAllDogSitter();

    $found = false;
    foreach ($allDogSitter as $key => $user) {
        if ($ID == $user["id_sitter"]) {
            $found = true;
            $index = $key;
            break;
        }
    }

    if ($found) {
        array_splice($allDogSitter, $index, 1);
        $json = json_encode($allDogSitter, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "/../dogsitter/dogsitter.json", $json);
        header("Location: ../sign-out.php");
    } else {
        echo "Gick ej att radera";
    }    
}