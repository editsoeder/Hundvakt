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
    <title>Min profil</title>
    <?php
        require_once __DIR__ . "/../section/header2.php";
    ?> 
<!-- </head> head stängs i header.php -->
<body>
    <?php 
    $loggedInID = $_SESSION["loggedInAsDogSitter"];
    $sitterInfo = idInfoSitter($_SESSION["loggedInAsDogSitter"]);
    $sitterName = $sitterInfo["first_name"] . " " . $sitterInfo["last_name"];
    $sitterCost = $sitterInfo["cost"];
    $sitterArea = implode(", ", $sitterInfo["areas"]);
    $sitterDays = implode(", ", $sitterInfo["days"]);
    $sitterLocation = $sitterInfo["location"];
    $sitterEmail = $sitterInfo["email"];
    $sitterExtra = $sitterInfo["extraInfo"];
    $src = '../userImages/' . $sitterInfo["image"];
    ?>

    <div id="wrapper-profile">
        <h1>Välkommen <?php echo $sitterName ?>!</h1>
        <img class='profile-image' src= <?php echo $src?>>
        <div id="wrapper-info">
            <p>Jag finns i:<br> <?php echo $sitterLocation ?> </p>
            <p>Jag passar hundar i:<br> <?php echo $sitterArea?> </p>
            <p>Dagar jag kan passa:<br><?php echo $sitterDays?> </p>
            <p>Min timlön är:<br>  <?php echo $sitterCost?> kr/tim </p>
        </div>
        <div id="wrapper-contact">
            <p>Hej! Mitt namn är <?php echo $sitterName ?> </p>
            <p>Du når mig på: <?php echo $sitterEmail ?> </p>
        </div>
        <div id="wrapper-extra_info">
            <p>Bra att veta om mig är:<br><?php echo $sitterExtra?> </p> 
        </div>

        <button class="changeSettingsButton"> Ändra Uppgifter </button> 
        <button type="submit" class="delete-account-button">Radera Konto</button>
    </div>

    
    <script >
        
        document.querySelector(".changeSettingsButton").addEventListener("click", function() {
            window.location.href = "update.php";
        });
        
        document.querySelector(".delete-account-button").addEventListener("click", function () {
            if (confirm("Vill du radera konto?")) {
                window.location.href = "delete.php";
            } else {
                window.location.href = "profile.php";
            }
        });

    </script>

    <?php
    require_once __DIR__ . "/../section/footer.php";
    ?>
</body>
</html>