<?php
error_reporting(-1);
session_start(); 
require_once __DIR__ . "/../section/header.php";
require_once __DIR__ . "/../functions.php";

?>

<div id="welcomemessage"> 
    <h2> Vad kul att du vill bli hundvakt!</h2>  
    <p> Vänligen fyll i fälten nedan. </p>
</div> 
<div class="form">
    <h2>Skapa konto</h2>
    <form class="createAccount" action="create.php" method="POST" enctype="multipart/form-data">
        <div id="dogsitter"> 
            <input type="text" name="firstName" placeholder="Förnamn"><br>
            <input type="text" name="lastName" placeholder="Efternamn"><br>
            <input type="email" name="email" placeholder="E-postadress"><br>
            <input type="password" name="password" placeholder="Lösenord"><br>

            <?php 
            createLocationList();
            createCostList();
            ?>                 
            <input type="text" name="extraInfo" placeholder="Bra att veta om mig:"> <br> <br>
        </div> 

        <div id="areaBox">
            <?php
            createAreaBoxes();
            ?> 
        </div> 

        <div id="dayBox"> 
            <h2> Kan hundvakta dessa dagar: </h2> 
            <?php 
            createDayBoxes();
            ?> 
        </div> 
        <div id="uploadImage"> 
            <h2> Ladda upp en profilbild </h2> 
            <input type="file" name="imageToUpload" id="fileToUpload">
        </div> 
        <button type="submit">Skapa konto</button> 
    </form>
</div>



<?php
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON("dogsitter.json");

    $newEntry = [ 
        "id_sitter" => getMaxID($data, "id_sitter") + 1,
        "first_name" => $_POST["firstName"],
        "last_name" => $_POST["lastName"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "location" => $_POST["Placering"],
        "cost" => $_POST["Timkostnad"],
        "days" => $_POST["days"],
        "areas" => $_POST["areas"],
        "extraInfo" => $_POST["extraInfo"],
        
    ];    
        if(is_null($newEntry) ){
            echo "<p class 'feedbackMessage'> Något gick fel, försök igen </p>";
            exit();
        }

        if (empty($newEntry["first_name"]) || empty($newEntry["last_name"]) || empty($newEntry["email"]) || empty($newEntry["password"]) || empty($newEntry["location"]) || empty($newEntry["cost"]) || empty($newEntry["days"]) || empty($newEntry["areas"])|| empty($newEntry["extraInfo"])) {
            echo "<p class 'feedbackMessage'> Alla fält måste vara ifyllda, försök igen </p>";
            exit();
        }

        if(strlen($newEntry["password"]) < 4) {
            echo "<p class 'feedbackMessage'> Lösenord måste vara minst 4 tecken långt </p>";
            exit();       
        }

        //vill skapa en if om email redan är registrerad för hundvakt, skicka felmeddelande "Denna e-postadress används redan för en hundvakt" typ

        addEntry("dogsitter.json", $newEntry);
        echo "<p class 'feedbackMessage'> Användare skapad! Nu kan du logga in</p>";

}
require_once __DIR__ . "/../section/footer.php";

?> 