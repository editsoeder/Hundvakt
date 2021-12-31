<?php
error_reporting(-1);
session_start(); 

require_once __DIR__ . "/../functions.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Skapa konto hundvakt</title>    
    <?php require_once __DIR__ . "/../section/header2.php"; ?>

<!-- </head>  stängs i header -->
<body>
    <div class="formWrapper">
        <form class="createAccount" action="create.php" method="POST" enctype="multipart/form-data">
            <div class="welcomemessage"> 
                <h2> Vad kul att du vill bli hundvakt!</h2>  
                <p> Vänligen fyll i fälten nedan. </p>
            </div> 
            <div id="createDogsitter"> 
                <h2 class="areasText"> Uppgifter om mig: </h2>
                <input type="text" name="firstName" class="createDetails" placeholder="Förnamn"><br>
                <input type="text" name="lastName" class="createDetails" placeholder="Efternamn"><br>
                <input type="email" name="email" class="createDetails" placeholder="E-postadress"><br>
                <input type="password" name="password" class="createDetails" placeholder="Lösenord"><br>     
                
                <?php 
                createLocationList();
                createCostList();
                ?>                
                <input type="text" class="extraInfo" class="createDetails" name="extraInfo" placeholder="Bra att veta om mig:"> <br>
            </div> 

            
            <div id="createAreaBox">
                <?php
                createAreaBoxes();
                ?> 
            </div> 

            <div id="createDayBox"> 
                <h2 class="areasText"> Kan hundvakta dessa dagar: </h2> 
                <?php 
                createDayBoxes();
                ?> 
            </div> 

            <div id="profilePicDiv"> 
                <div id="actualPicture"> </div>
                <h2> Ladda upp en profilbild </h2> 
                <input type="file" name="imageToUpload">
            </div>
            <button class="createButton" type="submit"> Skapa konto </button> 
        </form>
    </div>

<?php 
    require_once __DIR__ . "/../section/footer.php";
?> 
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON("dogsitter.json");
    //Kolla att de skickat med en bildfil och generera ett unikt 
    //namn för bilden
    if (isset($_FILES["imageToUpload"])) {
        $file = $_FILES["imageToUpload"];
        $filename = $file["name"];
        $tempname = $file["tmp_name"];
        $uniqueFilename = sha1(time().$filename);
        $size = $file["size"];

        if ($size > 4 * 1000 * 1000) {
            echo "Filen får inte vara större än 4mb";
            exit();
        }

        //Hämta filinformation & kolla vilken filtyp det är
        $info = pathinfo($filename);
        $extension = strtolower($info["extension"]);
        //Spara bilden med unikt namn i mappen "userImages"
        move_uploaded_file($tempname, __DIR__ . "/../userImages/$uniqueFilename.$extension");
    }

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
        "image" => $uniqueFilename.'.'.$extension //spara unika namnet på bilden som sökväg
        
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
    echo "<div class='feedbackDiv'> <p>Användare skapad! Nu kan du </p> <a href='../sign-in.php'>logga in</a> </div>";
}
?>