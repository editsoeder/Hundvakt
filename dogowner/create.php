<?php
session_start(); 
require_once __DIR__ . "/../functions.php";

if (!isset($_SESSION["loggedInAsDogSitter"]) & !isset($_SESSION["loggedInAsDogOwner"])) {
    header("Location: ../sign-in.php");
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Skapa konto hundägare</title>    
    <?php require_once __DIR__ . "/../section/header2.php"; ?>

<!-- </head> stängs i header.php -->
<body>
    <div class="formWrapper">
        <form class="createAccount" action="create.php" method="POST" enctype="multipart/form-data">
            <div class="welcomemessage"> 
                <h2> Vad kul att du söker hundvakt!</h2>  
                <p> Vänligen fyll i fälten nedan. </p>
            </div> 
            <div id="dogowner"> 
                <h2 class="areasText"> Uppgiter om mig: </h2>
                <input type="text" name="firstName" class="createDetails" placeholder="Förnamn"><br>
                <input type="text" name="lastName" class="createDetails" placeholder="Efternamn"><br>
                <input type="email" name="email" class="createDetails" placeholder="E-postadress"><br>
                <input type="password" name="password" class="createDetails" placeholder="Lösenord"><br>

                <?php 
                createLocationList();
                createCostList();
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
                <div class="dogPic"> </div> 
                <h2> Ladda upp bild på din hund </h2> 
                <input type="file" name="dogImage">
            </div>                 
            <button class="createButton" type="submit">Skapa konto</button>
        </form>
    </div>
    
    <?php 
    require_once __DIR__ . "/../section/footer.php";
    ?>
</body>
</html>

<?php 
// //samlar användardatan från formuläret in i $newEntry och använder 
// //funktionen "addEntry" för att spara datan i json-filen
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON("dogowners.json");
    //Kolla att de skickat med en bildfil och generera ett unikt 
    //namn för bilden

    if (isset($_FILES["dogImage"])) {
        $file = $_FILES["dogImage"];
        $filename = $file["name"];
        $tempname = $file["tmp_name"];
        $uniqueFilename = sha1(time().$filename);
        $size = $file["size"];

        if ($size > 4 * 1000 * 1000) {
            "<p class 'feedbackMessage'> Filen får inte vara större än 4mb </p>";
            exit();
        }

        //Hämta filinformation & kolla vilken filtyp det är
        $info = pathinfo($filename);
        $extension = strtolower($info["extension"]);
        //Spara bilden med unikt namn i mappen "userImages"
        move_uploaded_file($tempname, __DIR__ . "/../userImages/$uniqueFilename.$extension");
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
        "image" => $uniqueFilename.'.'.$extension //spara unika namnet på bilden som sökväg
        ]
    ];    
        if(is_null($newEntry) ){
            echo "<p class 'feedbackMessage'> Något gick fel, försök igen </p>";
            exit();
        }
        
        if (empty($newEntry["first_name"]) || empty($newEntry["last_name"]) || empty($newEntry["email"]) || empty($newEntry["password"]) || empty($newEntry["location"]) || empty($newEntry["cost"]) || empty($newEntry["days"]) || empty($newEntry["dog"]["dogName"])|| empty($newEntry["dog"]["breed"]) || empty($newEntry["dog"]["gender"]) || empty($newEntry["dog"]["image"])|| empty($newEntry["dog"]["extraInfo"])) {
            echo "<p class 'feedbackMessage'> Alla fält måste vara ifyllda, försök igen </p>";
            exit();
        }

        if(strlen($newEntry["password"]) < 4) {
            echo "<p class 'feedbackMessage'> Lösenord måste vara minst 4 tecken långt </p>";
            exit();
        }

        if (in_array($newEntry["email"], $data)) {
            echo "<p class 'feedbackMessage'> E-postadressen används redan för en annan hundägare </p>";
            exit();
        }
        //vill skapa en if om email redan är registrerad för hundägare, skicka felmeddelande "Denna e-postadress används redan för en hundägare" typ

        addEntry("dogowners.json", $newEntry);
        echo "<p class 'feedbackMessage'> Användare skapad! Nu kan du logga in </p>";
        exit();
} 

?>