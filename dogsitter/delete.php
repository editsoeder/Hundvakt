<?php
session_start();
error_reporting(-1);
require_once __DIR__ . "/../functions.php";

if (!isset($_SESSION["loggedInAsDogSitter"])) {
    if(isset($_SESSION["loggedInAsDogOwner"])) {
        header("Location: ../dogowner/profile.php");
        exit();
    } else {
        header("Location: ../sign-in.php");
        exit();
    }
}

if (isset($_SESSION["loggedInAsDogSitter"])) {
    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("dogsitter.json", "dogsitter_backup.json");
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