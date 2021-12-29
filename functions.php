<?php 
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

function validUser($users, $email, $password) {
    foreach ($users as $user) {
        if ($user["email"] === $email && $user["password"] === $password) {

            // Spara user id i session
            $_SESSION["id"] = $user["id"];

            return true;
        } 
    }
    return false;
}

//Kolla om email finns i DB
function validEmail($users, $email){
    foreach ($users as $user) {
        if ($user["email"] === $email) {
            return true;
        }
    }
    return false;
}

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
    $json = file_get_contents(__DIR__ . "../dogsitter/dogsitter.json"); //Byt TILL DIR GREJJEN
    $data = json_decode($json, true);

    $allDogSitter = $data;

    return $allDogSitter;
}

//Hämta alla dogowner från DB
function getAllDogOwner(){
    $json = file_get_contents(__DIR__ . "../dogowner/dogowners.json");
    $data = json_decode($json, true);

    $allDogOwner = $data;

    return $allDogOwner;
}

//kollar efter särskild URL.
function checkIfURL($stringInURL){
    if (strpos($_SERVER['REQUEST_URI'], "$stringInURL") !== false){
    return true;
    } else {
        return false;
    }
}

function idInfoSitter($id){
    $json = file_get_contents( __DIR__ . "../dogsitter/dogsitter.json");
    $data = json_decode($json, true);
    $allSitters = $data;
    foreach($allSitters as $sitter){
        if($sitter["id_sitter"] == $id){
            return $sitter;
        }
    }
}
function idInfoOwner($id){
    $json = file_get_contents( __DIR__ . "../dogowner/dogowners.json");
    $data = json_decode($json, true);
    $allOwners = $data;
    foreach($allOwners as $owner){
        if($owner["id_owner"] == $id){
            return $owner;
        }
    }
}

//Skapar checkboxarna som kan användas i de olika formulären, denna gäller områden i malmö
function createAreaBoxes() {
?>  <div class="areaWrapper"> 
        <h2 class="areasText"> Tillgänglig i områden: </h2> 
        <input type="checkbox" id="Fosie" name="areas[]" value="Fosie">
        <label for="Fosie"> Fosie </label><br>
        <input type="checkbox" id="Husie" name="areas[]" value="Husie">
        <label for="Husie"> Husie </label><br>
        <input type="checkbox" id="Hyllie" name="areas[]" value="Hyllie">
        <label for="Hyllie"> Hyllie </label><br>
        <input type="checkbox" id="Kirseberg" name="areas[]" value="Kirseberg">
        <label for="Kirseberg"> Kirseberg </label><br>
        <input type="checkbox" id="Limhamn-Bunkeflo" name="areas[]" value="Limhamn-Bunkeflo">
        <label for="Limhamn-Bunkeflo"> Limhamn-Bunkeflo </label><br>
        <input type="checkbox" id="MalmoCentrum" name="areas[]" value="Malmö Centrum">
        <label for="MalmoCentrum"> Malmö Centrum </label><br>
        <input type="checkbox" id="Oxie" name="areas[]" value="Oxie">
        <label for="Oxie"> Oxie </label><br>
        <input type="checkbox" id="Rosengard" name="areas[]" value="Rosengård">
        <label for="Oxie"> Rosengård </label><br>
        <input type="checkbox" id="SodraInnerstaden" name="areas[]" value="Södra Innerstaden">
        <label for="SodraInnerstaden"> Södra Innerstaden </label><br>
        <input type="checkbox" id="VastraInnerstaden" name="areas[]" value="Västra Innerstaden">
        <label for="Oxie"> Västra Innerstaden </label><br>
    </div>
<?php
}

//Skapar checkboxarna som kan användas i formulären, denna gäller dagar i veckan
function createDayBoxes() {
?> 
    <div class="dayWrapper">  
        <input type="checkbox" id="Monday" name="days[]" value="Måndag">
        <label for="Monday"> Måndag </label>
        <input type="checkbox" id="Tuesday" name="days[]" value="Tisdag">
        <label for="Tuesday"> Tisdag </label>
        <input type="checkbox" id="Wednesday" name="days[]" value="Onsdag">
        <label for="Wednesday"> Onsdag </label>
        <input type="checkbox" id="Thursday" name="days[]" value="Torsdag">
        <label for="Torsdag"> Torsdag </label>
        <input type="checkbox" id="Friday" name="days[]" value="Fredag">
        <label for="Friday"> Fredag </label>
        <input type="checkbox" id="Saturday" name="days[]" value="Lördag">
        <label for="Saturday"> Lördag </label>
        <input type="checkbox" id="Sunday" name="days[]" value="Söndag">
        <label for="Sunday"> Söndag </label>
    </div>  
<?php
}

//Skapar listan där man kan välja vilken timkostnad man har, kan användas i formulären
function createCostList() {
?>  <input list="hourCost" name="Timkostnad" placeholder="Kr i timmen"><br>
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

//Checkboxar till update.php
function createAreaBoxesUpdate() {
    ?>  <div class="areaWrapperUpdate"> 
            <h2 class="h2-update"> Tillgänglig i områden </h2> 
            <input type="checkbox" id="Fosie" name="areas[]" value="Fosie">
            <label for="Fosie"> Fosie </label><br>
            <input type="checkbox" id="Husie" name="areas[]" value="Husie">
            <label for="Husie"> Husie </label><br>
            <input type="checkbox" id="Hyllie" name="areas[]" value="Hyllie">
            <label for="Hyllie"> Hyllie </label><br>
            <input type="checkbox" id="Kirseberg" name="areas[]" value="Kirseberg">
            <label for="Kirseberg"> Kirseberg </label><br>
            <input type="checkbox" id="Limhamn-Bunkeflo" name="areas[]" value="Limhamn-Bunkeflo">
            <label for="Limhamn-Bunkeflo"> Limhamn-Bunkeflo </label><br>
            <input type="checkbox" id="MalmoCentrum" name="areas[]" value="Malmö Centrum">
            <label for="MalmoCentrum"> Malmö Centrum </label><br>
            <input type="checkbox" id="Oxie" name="areas[]" value="Oxie">
            <label for="Oxie"> Oxie </label><br>
            <input type="checkbox" id="Rosengard" name="areas[]" value="Rosengård">
            <label for="Oxie"> Rosengård </label><br>
            <input type="checkbox" id="SodraInnerstaden" name="areas[]" value="Södra Innerstaden">
            <label for="SodraInnerstaden"> Södra Innerstaden </label><br>
            <input type="checkbox" id="VastraInnerstaden" name="areas[]" value="Västra Innerstaden">
            <label for="Oxie"> Västra Innerstaden </label><br>
        </div>
    <?php
    }
    
    //Skapar checkboxarna som kan användas i update.php, denna gäller dagar i veckan
    function createDayBoxesUpdate() {
    ?> 
        <div class="dayWrapperUpdate">  
            <input class="input-update" type="checkbox" id="Monday" name="days[]" value="Måndag">
            <label for="Monday"> Måndag </label>
            <input class="input-update" type="checkbox" id="Tuesday" name="days[]" value="Tisdag">
            <label for="Tuesday"> Tisdag </label>
            <input class="input-update" type="checkbox" id="Wednesday" name="days[]" value="Onsdag">
            <label for="Wednesday"> Onsdag </label>
            <input class="input-update" type="checkbox" id="Thursday" name="days[]" value="Torsdag">
            <label for="Torsdag"> Torsdag </label>
            <input class="input-update" type="checkbox" id="Friday" name="days[]" value="Fredag">
            <label for="Friday"> Fredag </label>
            <input class="input-update" type="checkbox" id="Saturday" name="days[]" value="Lördag">
            <label for="Saturday"> Lördag </label>
            <input class="input-update" type="checkbox" id="Sunday" name="days[]" value="Söndag">
            <label for="Sunday"> Söndag </label>
        </div>  
    <?php
    }
    
    //Skapar listan där man kan välja vilken timkostnad man har, kan användas i formulären update.php
    function createCostListUpdate() {
    ?>  <input list="hourCost" name="Timkostnad" placeholder="Kr i timmen"><br>
        <datalist id="hourCost">
            <option value="<50">
            <option value="60">
            <option value="70">
            <option value="80">
            <option value="90">
            <option value=">100">
        </datalist> <?php 
    }
    
    //Skapar listan där man kan välja var man är placerad, kan användas i formulären update.php
    function createLocationListUpdate() {
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

// Letar igenom api:n och kollar vilket det högsta 
// ID:et är, används sedan när man skapar konto
function getMaxID($data, $id){
    if( count($data) < 1 ) {
        return 0;
    }
    $column = array_column($data, $id);
    $maxID = max($column);
    return $maxID;
}

// Lägger till en ny hundägare eller hundvakt med data från formuläret
function addEntry ($filename, $entry) {
    $data = loadJSON($filename);
    array_push($data, $entry);
    saveJson($filename, $data);
}

?>