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

// Skicka ut JSON till en anvĂ¤ndare
function send($data, $statusCode = 200) {
    header("Content-Type: application/json");
    http_response_code($statusCode);
    $json = json_encode($data);
    echo $json;
    exit();
}

function loadJson($filename) {
    $json = file_get_contents($filename);
    return json_decode($json, true);
}

function saveJson($filename, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filename, $json);
}

//Hämta alla dogsitter från DB
function getAllDogSitter(){
    $json = file_get_contents("dogsitter.json");
    $data = json_decode($json, true);

    $allDogSitter = $data;

    return $allDogSitter;
}

//kollar efter särskild URL.
function checkIfURL($stringInURL){
    if (strpos($_SERVER['REQUEST_URI'], "$stringInURL") !== false){
    return true;
    } else {
        return false;
    }
}

//DOM för en (1) hund.
function showOneDog($info){

    $allDogSitter = getAllDogSitter();

    //Konvertera array till string
    $days = implode(" ",$info["days"]);
    
    if (checkIfURL("read") == true){
        $div = "
            <div class='listCard'>
                <p>{$info['first_name']}</p>
                <p>{$info['location']}</p>
                <p>{$days}</p>
                <p>{$info['cost']}</p>
                <img src='' alt='Profil picture'>
                <a href='read.php?id={$info['id_sitter']}'>Läs mer</a>
            </div>
         ";
    }
    return $div;
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

//Skapar checkboxarna som kan användas i de olika formulären, denna gäller områden i malmö
function createAreaBoxes() {
?>  <div id="areaWrapper"> 
        <h2> Tillgänglig i områden </h2> 
        <input type="checkbox" id="Fosie" name="Fosie" value="Fosie">
        <label for="Fosie"> Fosie </label><br>
        <input type="checkbox" id="Husie" name="Husie" value="Husie">
        <label for="Husie"> Husie </label><br>
        <input type="checkbox" id="Hyllie" name="Hyllie" value="Hyllie">
        <label for="Hyllie"> Hyllie </label><br>
        <input type="checkbox" id="Kirseberg" name="Kirseberg" value="Kirseberg">
        <label for="Kirseberg"> Kirseberg </label><br>
        <input type="checkbox" id="Limhamn-Bunkeflo" name="Limhamn-Bunkeflo" value="Limhamn-Bunkeflo">
        <label for="Limhamn-Bunkeflo"> Limhamn-Bunkeflo </label><br>
        <input type="checkbox" id="MalmoCentrum" name="MalmoCentrum" value="Malmö Centrum">
        <label for="MalmoCentrum"> Malmö Centrum </label><br>
        <input type="checkbox" id="Oxie" name="Oxie" value="Oxie">
        <label for="Oxie"> Oxie </label><br>
        <input type="checkbox" id="Rosengard" name="Rosengard" value="Rosengård">
        <label for="Oxie"> Rosengård </label><br>
        <input type="checkbox" id="SodraInnerstaden" name="SodraInnerstaden" value="Södra Innerstaden">
        <label for="SodraInnerstaden"> Södra Innerstaden </label><br>
        <input type="checkbox" id="VastraInnerstaden" name="VastraInnerstaden" value="Västra Innerstaden">
        <label for="Oxie"> Västra Innerstaden </label><br>
    </div>
<?php
}

//Skapar checkboxarna som kan användas i formulären, denna gäller dagar i veckan
function createDayBoxes() {
?> 
    <div id="dayWrapper"> 
        <h2> Tillgängliga dagar </h2> 
        <input type="checkbox" id="Monday" name="Monday" value="Måndag">
        <label for="Monday"> Måndag </label><br>
        <input type="checkbox" id="Tuesday" name="Tuesday" value="Tisdag">
        <label for="Tuesday"> Tisdag </label><br>
        <input type="checkbox" id="Wednesday" name="Wednesday" value="Onsdag">
        <label for="Wednesday"> Onsdag </label><br>
        <input type="checkbox" id="Thursday" name="Thursday" value="Torsdag">
        <label for="Torsdag"> Torsdag </label><br>
        <input type="checkbox" id="Friday" name="Friday" value="Fredag">
        <label for="Friday"> Fredag </label><br>
        <input type="checkbox" id="Saturday" name="Saturday" value="Lördag">
        <label for="Saturday"> Lördag </label><br>
        <input type="checkbox" id="Sunday" name="Sunday" value="Söndag">
        <label for="Sunday"> Söndag </label><br>
    </div>  
<?php
}

//Skapar listan där man kan välja vilken timkostnad man har, kan användas i formulären
function createDayList() {
?>  <input list="hourCost" name="Timkostnad" placeholder="Timkostnad i kr"><br>
    <datalist id="hourCost">
        <option value="<50">
        <option value="60">
        <option value="70">
        <option value="80">
        <option value="90">
        <option value=">100">
    </datalist> <?php 
}

//Skapar listan där man kan välja var man är placerad, kan användas i formulären
function createLocationList() {
?>  <input list="placement" name="Placering" placeholder="Placering"><br> 
    <datalist id="placement">
        <option value="Fosie">
        <option value="Husie">
        <option value="Hyllie">
        <option value="Kirseberg">
        <option value="Limhamn-Bunkeflo">
        <option value="Malmö Centrum">
        <option value="Oxie">
        <option value="Rosengård">
        <option value="Södra Innerstaden">
        <option value="Västra Innerstaden">
    </datalist>
<?php
}
?> 
