<?php
session_start(); 
require_once __DIR__ . "/../section/header.php";
require_once __DIR__ . "/../functions.php";

// //samlar användardatan från formuläret in i $newEntry och använder 
// //funktionen "addEntry" för att spara datan i json-filen
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON("dogowners.json");
    $newEntry = [ 
        "id_owner" => getMaxID($data, "id_owner") + 1, 
        "first_name" => $_POST["firstName"],
        "last_name" => $_POST["lastName"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "location" => $_POST["Placering"],
        "cost" => $_POST["Timkostnad"],
        "days" => $_POST["days"],
        "dog" => [
        "dogName" => $_POST["dogName"],
        "breed" => $_POST["breed"],
        "gender" => $_POST["gender"],
        "extraInfo" => $_POST["extraInfo"]
        ]
    ];    
        if(is_null($newEntry) ){
            echo "<p class 'feedbackMessage'> Något gick fel, försök igen </p>";
            exit();
        }
        
        if (empty($newEntry["first_name"]) || empty($newEntry["last_name"]) || empty($newEntry["email"]) || empty($newEntry["password"]) || empty($newEntry["location"]) || empty($newEntry["cost"]) || empty($newEntry["days"]) || empty($newEntry["dog"]["dogName"])|| empty($newEntry["dog"]["breed"]) || empty($newEntry["dog"]["gender"]) || empty($newEntry["dog"]["extraInfo"])) {
            echo "<p class 'feedbackMessage'> Alla fält måste vara ifyllda, försök igen </p>";
            exit();
        }

        if(strlen($newEntry["password"]) < 4) {
            echo "<p class 'feedbackMessage'> Lösenord måste vara minst 4 tecken långt </p>";
            exit();
        }

        if (in_array($newEntry["email"], $data)) {
            echo "<p class 'feedbackMessage'> E-postadressen används redan för en annan hundägare </p>";
        }
        //vill skapa en if om email redan är registrerad för hundägare, skicka felmeddelande "Denna e-postadress används redan för en hundägare" typ

        addEntry("dogowners.json", $newEntry);
        echo "<p class 'feedbackMessage'> Användare skapad, nu kan du logga in </p>";
} 

?> 
<div id="createDogowner"> 
    <div class="welcomeMessage"> 
        <h2> Vad kul att du söker hundvakt! </h2>
        <p> Vänligen fyll i fälten nedan. </p>
    </div> 
    <div class="form">
        <form class="createAccount" action="create.php" method="POST">
            <div id="dogowner"> 
                <h2> Mina uppgifter </div> 
                <input type="text" name="firstName" placeholder="Förnamn"><br>
                <input type="text" name="lastName" placeholder="Efternamn"><br>
                <input type="email" name="email" placeholder="E-postadress"><br>
                <input type="password" name="password" placeholder="Lösenord"><br>

                <?php 
                createLocationList();
                createCostList();
                ?> 
                <h2> Behov av hundvakt dessa dagar: </h2>
                <?php 
                createDayBoxes();
                ?>
            </div> 
            <div id="dogDiv"> 
                <h2> Hunden: </h2> 
                <input type="text" name="dogName" placeholder="Namn"><br>
                <input type="text" name="breed" placeholder="Ras"><br>
                <div id="genderDiv"> 
                    <input type="checkbox" id="Monday" name="gender" value="Hona">
                    <label for="Hona"> Hona </label><br>
                    <input type="checkbox" id="Hane" name="gender" value="Hane">
                    <label for="Hane"> Hane </label><br>
                </div> 
                <input type="text" name="extraInfo" placeholder="Bra att veta om hunden:">
            </div> 
            <button type="submit">Skapa konto</button> 
        </form>
    </div>
</div> 
<?php 
require_once __DIR__ . "/../section/footer.php";
?> 