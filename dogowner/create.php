<?php
session_start();
error_reporting(-1);
require_once __DIR__ . "/../functions.php";

// //samlar användardatan från formuläret in i $newEntry och använder 
// //funktionen "addEntry" för att spara datan i json-filen
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON( __DIR__ . "/../dogowner/dogowners.json");
    $file = $_FILES["dogImage"];

    //Kolla att de skickat med en bildfil och generera ett unikt 
    //namn för bilden
    if (isset($file) && $file["error"] != 4) {
        $filename = $file["name"];
        $tempname = $file["tmp_name"];
        $uniqueFilename = sha1(time().$filename);
        $size = $file["size"];

        if ($size > 4 * 1000 * 1000) {
            "<p class='feedbackMessage'> Filen får inte vara större än 4mb </p>";
            exit();
        }

        //Hämta filinformation & kolla vilken filtyp det är
        $info = pathinfo($filename);
        $extension = strtolower($info["extension"]);
        $imageName = $uniqueFilename.'.'.$extension;
    }
    else {
        $imageName = "";
    }

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
        "extraInfo" => $_POST["extraInfo"],
        "image" => $imageName //spara unika namnet på bilden som sökväg
        ]
    ];    
    if(validEmail($data, $newEntry["email"]) == true ) {
        header("Location: create.php?error=4");
        exit();
    }

    if(is_null($newEntry) ){
        header("Location: create.php?error=5");
        exit();
    }
    
    if (empty($newEntry["first_name"]) || empty($newEntry["last_name"]) || empty($newEntry["email"]) || empty($newEntry["password"]) || empty($newEntry["location"]) || empty($newEntry["cost"]) || empty($newEntry["days"]) || empty($newEntry["dog"]["dogName"])|| empty($newEntry["dog"]["breed"]) || empty($newEntry["dog"]["gender"]) || empty($newEntry["dog"]["extraInfo"])) {
        header("Location: create.php?error=1");
        exit();
    }

    if(empty($newEntry["dog"]["image"]) ){
        header("Location: create.php?error=6");
        exit();
    }

    if(strlen($newEntry["password"]) < 4) {
        header("Location: create.php?error=2");
        exit();
    }

    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("dogowners.json", "dogowners_backup.json");

    //Spara bilden med unikt namn i mappen "userImages"
    move_uploaded_file($tempname, __DIR__ . "/../userImages/$imageName");
    addEntry( __DIR__ . "/../dogowner/dogowners.json", $newEntry);
    header("Location: ../sign-in.php?createdAccount");
    exit();
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Skapa konto hundägare</title>    
    <?php require_once __DIR__ . "/../section/header.php"; ?>

<!-- </head> stängs i header.php -->
<body>
    <button class="backToHomeCreate">Hem</button>

    <div class="formWrapper">
        <form class="createAccount" action="create.php" method="POST" enctype="multipart/form-data">
            <div class="welcomemessage"> 
            <?php // Kontrollera om "error" finns i vår URL
            if (isset($_GET["success"])) {
                echo '<div class="feedbackMessage"> <p> Användare skapad! Nu kan du </p> <a id="messageCreate" href="../sign-in.php">logga in</a> </p> </div>';
            } elseif (isset($_GET["error"])) {
                $error = $_GET["error"];

                // Felmeddelande
                if ($error == 1) {
                    echo '<p class="errorCreate">Alla fält måste vara ifyllda, testa igen.</p>';
                } elseif ($error == 2) {
                    echo '<p class="errorCreate">Lösenordet måste vara minst 4 tecken</p>';
                } elseif ($error == 3) {
                    echo '<p class="errorCreate"> Filen får inte vara större än 4mb</p>';
                } elseif ($error == 4) {
                    echo '<p class="errorCreate">E-postadressen används redan</p>';
                } elseif ($error == 6) {
                    echo '<p class="errorCreate">Ingen bild laddades upp, försök igen.</p>';
                } elseif ($error == 5) {
                    echo '<p class="errorCreate">Något gick fel, försök igen</p>';
                } 
            } else {
                echo '<h2> Vad kul att du söker hundvakt!</h2> <p> Vänligen fyll i fälten nedan. </p>';
            } 
            ?> 
            </div> 
            <div id="dogowner"> 
                <h2 class="areasText"> Uppgiter om mig: </h2>
                <input type="text" name="firstName" class="createDetails" placeholder="Förnamn"><br>
                <input type="text" name="lastName" class="createDetails" placeholder="Efternamn"><br>
                <input type="email" name="email" class="createDetails" placeholder="E-postadress"><br>
                <input type="password" name="password" class="createDetails" placeholder="Lösenord"><br>

                <?php 
                createPlacementList();
                createCostBar();
                ?> 
            </div> 
            
            <div id="dogDays">
                <h2 class="areasText"> Behov av hundvakt: </h2>
                <?php 
                createDayBoxes();
                ?>
            </div> 
            
            <div id="dogDiv"> 
                <h2> Information om hunden: </h2> <br>
                <input type="text" name="dogName" class="createDetails" placeholder="Namn"><br>
                <input type="text" name="breed" class="createDetails" placeholder="Ras"><br>                
                <input type="text" name="extraInfo" class="extraInfo" placeholder="Bra att veta om hunden:">
                <div id="genderDiv"> 
                    <input type="checkbox" class="genderCheckbox" name="gender" value="Hona">
                    <label for="Hona"> Hona </label><br>
                    <input type="checkbox" class="genderCheckbox"  name="gender" value="Hane">
                    <label for="Hane"> Hane </label><br>                
                </div>
            </div> 
            <div id="dogPicDiv"> 
            <img id="output_image" src="../Images/dogavatar.jpeg"/>
                <h2> Ladda upp bild på din hund </h2> 
                <input type="file" name="dogImage" accept="image/*" onchange="preview_image(event)">
            </div>                 
            <button class="createButton" type="submit">Skapa konto</button>
        </form>
    </div>

    <?php 
    require_once __DIR__ . "/../section/footer.php";
    ?>

    <script> 
    document.querySelector(".backToHomeCreate").addEventListener("click", function() {
        window.location.href = "../index.php";
    });

    function preview_image(event) {
        var reader = new FileReader();

        reader.onload = function(){
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
</body>
</html>

