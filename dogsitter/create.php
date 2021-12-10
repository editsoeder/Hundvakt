<?php
session_start(); 
require_once "../section/header.php";
include "../functions.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    	<link rel="stylesheet" href="../style.css">
	    <title>Skapa konto</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="welcomemessage"> 
            <h2> Vad kul att du vill bli hundvakt!</h2>  
            <p> Vänligen fyll i fälten nedan. </p>
        </div> 
        <div class="form">
            <h2>Skapa konto</h2>
            <form class="createAccount" action="create.php" method="POST">
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
                <button type="submit">Skapa konto</button> 
            </form>
        </div>
    </body>
</html>


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
        "extraInfo" => $_POST["extraInfo"]
    ];    
        if(is_null($newEntry) ){
            send(["message" => "Bad Request"], 400);
            exit();
        }
        
        addEntry("dogsitter.json", $newEntry);
        send(["Message" => "User created"], 200) ;
        exit();

} else{
    send(["message"=>"Wrong Method"], 405);
    exit();
 
}
require_once "../section/footer.php";

?> 