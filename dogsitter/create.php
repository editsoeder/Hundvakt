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
        "first_name" => utf8_encode($_POST["firstName"]),
        "last_name" => $_POST["lastName"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "location" => $_POST["Placering"],
        "cost" => $_POST["Timkostnad"],
        "days" => $_POST["days"],
        "areas" => $_POST["areas"],
        "extraInfo" => $_POST["extraInfo"],
        
    ];    
        // if(is_null($newEntry) ){
        //     send(["message" => "Bad Request"], 400);
        //     exit();
        // }
        
        addEntry("dogsitter.json", $newEntry);
        echo "User created";
        // send(["Message" => "User created"], 200) ;
        // exit();

// } 
// else{
//     // send(["message"=>"Wrong Method"], 405);
//     exit();

}
require_once __DIR__ . "/../section/footer.php";

?> 