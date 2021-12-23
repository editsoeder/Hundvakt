<?php
error_reporting(-1);
session_start();
require_once __DIR__ . "/../section/header.php";
require_once __DIR__ . "/../functions.php";
$loggedInID = $_SESSION["loggedInAsDogSitter"];
$sitterInfo = idInfoSitter($_SESSION["loggedInAsDogSitter"]);
$sitterFirstName = $sitterInfo["first_name"];
$sitterLastName = $sitterInfo["last_name"];
$sitterCost = $sitterInfo["cost"];
$sitterArea = implode(" ", $sitterInfo["areas"]);
$sitterDays = implode(" ", $sitterInfo["days"]);
$sitterLocation = $sitterInfo["location"];
$sitterEmail = $sitterInfo["email"];
$sitterExtra = $sitterInfo["extra_info"];
$sitterPassword = $sitterInfo["password"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update your page</title>
</head>
<body>
<h1>Här kan du ändra din profil!</h1>
<div class="form">
    <form class="createAccount" action="create.php" method="POST" enctype="multipart/form-data">
        <div id="dogsitter"> 
            <p class="input-text">Förnamn</p><input type="text" name="firstName" placeholder="<?php echo $sitterFirstName ?>"><br>
            <p class="input-text">Efternamn</p><input type="text" name="lastName" placeholder="<?php echo $sitterLastName ?>"><br>
            <p class="input-text">Email</p><input type="email" name="email" placeholder="<?php echo $sitterEmail ?>"><br>
            <p class="input-text">Nytt Lösenord</p><input type="password" placeholder ="<?php echo $sitterPassword ?>"placeholder="Skriv Nytt Lösenord"<br>
            <p class="input-text">Timkostnad</p><input type="text" name="cost" placeholder="<?php echo $sitterCost ?>"><p>kr/timm</p><br>
            <p class="input-text">Bra att veta</p><input type="text" name="extraInfo" placeholder="<?php echo $sitterExtra ?>"> <br> <br>
            <div id="areaBox">
            <?php
            createAreaBoxes();
            ?> 
        </div> 

        <div id="dayBox"> 
            <h2> Dagar jag kan vakta </h2> 
            <?php 
            createDayBoxes();
            ?> 
        </div> 
        <div id="uploadImage"> 
            <h2> Ladda upp en ny profilbild </h2> 
            <input type="file" name="imageToUpload" id="fileToUpload">
        </div> 
        </div> 
</body>
</html>