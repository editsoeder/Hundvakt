<?php
error_reporting(-1);
session_start();
require_once __DIR__ . "/../functions.php";

if (!isset($_SESSION["loggedInAsDogOwner"])) {
    if(isset($_SESSION["loggedInAsDogSitter"])) {
        header("Location: ../dogsitter/profile.php");
        exit();
    } else {
        header("Location: ../sign-in.php");
        exit();
    }
}

if (isset($_SESSION["loggedInAsDogOwner"])) {
    deleteDog($_SESSION["loggedInAsDogOwner"]);
} 

elseif (!isset($_SESSION["loggedInAsDogOwner"])) {
    header("Location: ../sign.out.php");
    exit();
}

//Radera användare från json filen
function deleteDog($ID) {
    $allDogOwner = getAllDogOwner();

    $found = false;
    foreach ($allDogOwner as $key => $user) {
        if ($ID == $user["id_owner"]) {
            $found = true;
            $index = $key;
            break;
        }
    }

    if ($found) {
        array_splice($allDogOwner, $index, 1);
        $json = json_encode($allDogOwner, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "/../dogowner/dogowners.json", $json);
        header("Location: ../sign-out.php");
    } else {
        echo "Gick ej att radera";
    }    
}