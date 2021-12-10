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
            <h2> Vad kul att du söker hundvakt!</h2>  
            <p> Vänligen fyll i fälten nedan. </p>
        </div> 
        <div class="form">
            <h2>Skapa konto</h2>
            <form class="createAccount" action="create.php" method="POST">
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
                <button type="submit">Skapa konto</button> 
            </form>
        </div>
    </body>
</html>


<?php
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
        "race" => $_POST["breed"],
        "gender" => $_POST["gender"],
        "extraInfo" => $_POST["extraInfo"]
        ]
    ];    
        if(is_null($newEntry) ){
            send(["message" => "Bad Request"], 400);
            exit();
        }

        addEntry("dogowners.json", $newEntry);
        send(["Message" => "User created"], 200) ;
        exit();
} else{ //Om metoden inte är POST
    send(["message"=>"Wrong Method"], 405);
    exit();
}


require_once "../section/footer.php";

?> 