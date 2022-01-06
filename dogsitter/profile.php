<?php 
error_reporting(-1);
session_start();
require_once __DIR__ . "/../functions.php";
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Min profil</title>
    <?php
        require_once __DIR__ . "/../section/header.php";
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

    <div class="wrapper-profile">
        <h1>Välkommen <?php echo $sitterName ?>!</h1>
        <img class='profile-image' src= <?php echo $src?>>
        <div id="wrapper-info">
            <p>Placering:<br> <?php echo $sitterLocation ?> </p>
            <p>Passar hundar i:<br> <?php echo $sitterArea?> </p>
            <p>Tillgänglig:<br><?php echo $sitterDays?> </p>
            <p>Timlön:<br>  <?php echo $sitterCost?> kr/tim </p>
        </div>
        <div id="wrapper-contact">
            <h2>Kontaktuppgifter</h2>
            <p>Mail:</p>
            <p><?php echo $sitterEmail ?> </p>
        </div>
        <div id="wrapper-extra_info">
            <p>Bra att veta:<br><?php echo $sitterExtra?> </p> 
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