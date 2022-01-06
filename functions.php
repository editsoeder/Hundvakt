<?php 

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
    $json = file_get_contents(__DIR__ . "/dogsitter/dogsitter.json"); 
    $data = json_decode($json, true);

    $allDogSitter = $data;

    return $allDogSitter;
}

//Hämta alla dogowner från DB
function getAllDogOwner(){
    $json = file_get_contents(__DIR__ . "/dogowner/dogowners.json");
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
    $json = file_get_contents( __DIR__ . "/dogsitter/dogsitter.json");
    $data = json_decode($json, true);
    $allSitters = $data;
    foreach($allSitters as $sitter){
        if($sitter["id_sitter"] == $id){
            return $sitter;
        }
    }
}
function idInfoOwner($id){
    $json = file_get_contents( __DIR__ . "/dogowner/dogowners.json");
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
        <input type="checkbox" id="Fosie" class="areaCheckbox" name="areas[]" value="Fosie">
        <label for="Fosie"> Fosie </label><br>
        <input type="checkbox" id="Husie" class="areaCheckbox" name="areas[]" value="Husie">
        <label for="Husie"> Husie </label><br>
        <input type="checkbox" id="Hyllie" class="areaCheckbox" name="areas[]" value="Hyllie">
        <label for="Hyllie"> Hyllie </label><br>
        <input type="checkbox" id="Kirseberg" class="areaCheckbox" name="areas[]" value="Kirseberg">
        <label for="Kirseberg"> Kirseberg </label><br>
        <input type="checkbox" id="Limhamn-Bunkeflo" class="areaCheckbox" name="areas[]" value="Limhamn-Bunkeflo">
        <label for="Limhamn-Bunkeflo"> Limhamn-Bunkeflo </label><br>
        <input type="checkbox" id="MalmoCentrum" class="areaCheckbox"name="areas[]" value="Malmö Centrum">
        <label for="MalmoCentrum"> Malmö Centrum </label><br>
        <input type="checkbox" id="Oxie" class="areaCheckbox" name="areas[]" value="Oxie">
        <label for="Oxie"> Oxie </label><br>
        <input type="checkbox" id="Rosengard" class="areaCheckbox" name="areas[]" value="Rosengård">
        <label for="Oxie"> Rosengård </label><br>
        <input type="checkbox" id="SodraInnerstaden" class="areaCheckbox" name="areas[]" value="Södra Innerstaden">
        <label for="SodraInnerstaden"> Södra Innerstaden </label><br>
        <input type="checkbox" id="VastraInnerstaden" class="areaCheckbox" name="areas[]" value="Västra Innerstaden">
        <label for="Oxie"> Västra Innerstaden </label><br>
    </div>
<?php
}

//Skapar checkboxarna som kan användas i formulären, denna gäller dagar i veckan
function createDayBoxes() {
?> 
    <div class="dayWrapper">  
        <input type="checkbox" id="Monday" class="eachDayBox" name="days[]" value="Måndag">
        <label for="Monday"> Måndag </label> <br>
        <input type="checkbox" id="Tuesday" class="eachDayBox" name="days[]" value="Tisdag">
        <label for="Tuesday"> Tisdag </label> <br>
        <input type="checkbox" id="Wednesday" class="eachDayBox" name="days[]" value="Onsdag">
        <label for="Wednesday"> Onsdag </label> <br>
        <input type="checkbox" id="Thursday" class="eachDayBox" name="days[]" value="Torsdag">
        <label for="Torsdag"> Torsdag </label> <br>
        <input type="checkbox" id="Friday" class="eachDayBox" name="days[]" value="Fredag">
        <label for="Friday"> Fredag </label> <br>
        <input type="checkbox" id="Saturday" class="eachDayBox" name="days[]" value="Lördag">
        <label for="Saturday"> Lördag </label> <br>
        <input type="checkbox" id="Sunday" class="eachDayBox" name="days[]" value="Söndag">
        <label for="Sunday"> Söndag </label> <br>
    </div>  
<?php
}

function createCostListTwo() {
    ?>  <select name="costSelect" class="costSelect" placeholder="Kr i timmen">
            <option value="cost">Kr/timmen</option>
            <option value="50">50</option>
            <option value="60">60</option>
            <option value="70">70</option>
            <option value="80">80</option>
            <option value="90">90</option>
            <option value="100">100</option>
        </select> <?php 
}

//Skapar listan där man kan välja var man är placerad, kan användas i formulären
function createPlacementList() { 
?> 
<label for="Placering">Placering:</label>
    <select name="Placering" id="Placering" class="selectList">
        <option disabled selected value> -- Välj ett alternativ -- </option>
        <option value="Fosie">Fosie</option>
        <option value="Husie">Husie</option>
        <option value="Hyllie">Hyllie</option>
        <option value="Kirseberg">Kirseberg</option>
        <option value="Limhamn-Bunkeflo">Limhamn-Bunkeflo</option>
        <option value="Malmö Centrum">Malmö Centrum</option>
        <option value="Oxie">Oxie</option>
        <option value="Rosengård">Rosengård</option>
        <option value="Södra Innerstaden">Södra Innerstaden</option>
        <option value="Västra Innerstaden">Västra Innerstaden</option>
    </select>
<?php
}

//Skapar listan där man kan välja vilken timkostnad man har, kan användas i formulären
function createCostBar() {
    ?> 
    <label for="Cost">Kr/h:</label>
    <select name="Timkostnad" id="Cost" class="selectList">
        <option disabled selected value> -- Välj ett alternativ -- </option>
        <option value="50">50</option>
        <option value="60">60</option>
        <option value="70">70</option>
        <option value="80">80</option>
        <option value="90">90</option>
        <option value="100">100</option>
    </select>
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

//Uppdatera user
function updateUser ($filename, $entry) {
    $data = loadJSON($filename);
    array_push($data, $entry);
    saveJson($filename, $data);
}
?>