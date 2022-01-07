<?php 
error_reporting(-1);
session_start();
require_once "functions.php";

$allDogSitter = getAllDogSitterAPI();

//Om inloggad! FIXA SEN
// Om "id" finns i url
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    foreach($allDogSitter as $dogSitter){
        if ($dogSitter["id_sitter"] == $id) {
            $foundDogSitter = $dogSitter; 
        } 
    }

    if (isset($foundDogSitter)) { 

        send(
            
            ["message" => $foundDogSitter], 200
        ) ;

        exit(); 
        }

} else {
    //Visa alla
    send(
            
        ["message" => $allDogSitter ], 200
    ) ;

    exit(); 
}

?>