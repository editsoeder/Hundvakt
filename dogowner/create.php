<?php
session_start(); 
require_once __DIR__ . "/../section/header.php";
require_once __DIR__ . "/../functions.php";

?>
    <div class="welcomemessage"> 
        <h2> Vad kul att du söker hundvakt!</h2>  
        <p> Vänligen fyll i fälten nedan. </p>
    </div> 
    <div class="form">
        <form class="createAccount" action="create.php" method="POST" enctype="multipart/form-data">
            <div id="dogowner"> 
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
                <h2> Hunden: </2> 
                <input type="text" name="dogName" placeholder="Namn"><br>
                <input type="text" name="breed" placeholder="Ras"><br>
                <input type="checkbox" id="Monday" name="gender" value="Hona">
                <label for="Hona"> Hona </label><br>
                <input type="checkbox" id="Hane" name="gender" value="Hane">
                <label for="Hane"> Hane </label><br>
                <input type="text" name="extraInfo" placeholder="Bra att veta om hunden:">
            </div> 

            <p> Ladda upp bild på hunden </p> 
            <input type="file" name="dogImage">
            <button type="submit">Skapa konto</button> 
        </form>
    </div>

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

require_once __DIR__ . "/../section/footer.php";
?>