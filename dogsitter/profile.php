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
<<<<<<< HEAD
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
=======
        <div class="wrapper-dog">
            <p class="bold-text"><b>Jag finns i:</b></p><br><?php echo $sitterLocation; ?>
            <p class="bold-text"><b>Jag passar hundar i:</b></p><br> <?php echo $sitterArea;?>
            <p class="bold-text"><b>Dagar jag kan passa:</b></p><br><?php echo $sitterDays;?>
            <p class="bold-text"><b>Min timlön är: </b></p><br>  <?php echo $sitterCost?> <p>kr/tim</p>
        </div>
        <div class="wrapper-contact">
            <p><b>Hej! Mitt namn är</b></p><?php echo $sitterName; ?>
            <p><b>Du når mig på:</b></p><?php echo $sitterEmail; ?>
        </div>
        <div id="wrapper-extra_info">
            <p><b>Bra att veta om mig är:</b></p><br><?php echo $sitterExtra?> </p> 
>>>>>>> 82844ca66ca34488a2073ea75c658f588266660f
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