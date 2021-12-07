<?php 
error_reporting(-1);

$locations = [
    "Fosie", 
    "Husie", 
    "Hyllie", 
    "Kirseberg", 
    "Limhamn-Bunkeflo",
    "Malmö Centrum", 
    "Oxie", 
    "Rosengård", 
    "Södra Innerstaden", 
    "Västra Innerstaden"
];

$days = [
    "Måndag", 
    "Tisdag", 
    "Onsdag", 
    "Torsdag", 
    "Fredag", 
    "Lördag", 
    "Söndag"
];

$priceHour = [
    "<50",
    "70",
    "90", 
    "110", 
    "130", 
    ">150" 
];

//Hämta alla dogsitter från DB
function getAllDogsDB(){
    $json = file_get_contents("dogsitter/dogsitter.json");
    $data = json_decode($json, true);

    $allDogSitter = $data;

    return $allDogSitter;
}

function validUser($data, $email, $password) {
    foreach ($data as $user) {
        if ($user["email"] === $email && $user["password"] === $password) {

            if (isset($user["id_sitter"])) {
               // Spara user id i session
                $_SESSION["loggedInAsDogSitter"] = $user["id_sitter"];
            }

            if (isset($user["id_owner"])) {
                // Spara user id i session
                 $_SESSION["loggedInAsDogOwner"] = $user["id_owner"];
             } 

            return true;
        } 
    }
    return false;
}

//Kolla om email finns i DB
function validEmail($data, $email){
    foreach ($data as $user) {
        if ($user["email"] === $email) {
            return true;
        }
    }
    return false;
}
?>