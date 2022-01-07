<?php 
error_reporting(-1);
session_start();
require_once __DIR__ . "/../functions.php";

$allDogOwner = getAllDogOwnerAPI();

//Om inloggad! FIXA SEN
// Om "id" finns i url
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    foreach($allDogOwner as $dogOwner){
        if ($dogOwner["id_owner"] == $id) {
            $foundDogOwner = $dogOwner; 
            $dog = $dogOwner["dog"];
        } 
    }

    if (isset($foundDogOwner)) { 

        send(
            
            ["message" => $foundDogOwner], 200
        ) ;

        exit(); 
        }
    
} else {
    //Visa alla
    send(
            
        ["message" => $allDogOwner ], 200
    ) ;

    exit(); 
}

?>