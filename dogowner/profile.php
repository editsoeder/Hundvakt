<?php 
error_reporting(-1);
session_start();
if (!isset($_SESSION["loggedInAsDogOwner"])) {
    if(isset($_SESSION["loggedInAsDogSitter"])) {
        header("Location: ../dogsitter/profile.php");
        exit();
    } else {
        header("Location: ../sign-in.php");
        exit();
    }
}
require_once __DIR__ . "/../functions.php"; 
?> 

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Min profil</title>
    <?php 
        require_once __DIR__ . "/../section/header.php";
    ?> 
<!-- </head> stängs av header.php -->
<body>
    <?php
    $allDogOwner = getAllDogOwner();
    $ownerInfo = idInfoOwner($_SESSION["loggedInAsDogOwner"]);
    $ownerName = $ownerInfo["first_name"] . " " . $ownerInfo["last_name"];
    $ownerLocation = $ownerInfo["location"];
    $ownerDog = implode(" ", $ownerInfo["dog"]);
    $ownerDays = implode(" ", $ownerInfo["days"]);
    $ownerLocation = $ownerInfo["location"];
    $ownerCost = $ownerInfo["cost"];
    $ownerDogInfo = $ownerInfo["dog"];
    $ownerEmail = $ownerInfo["email"];

    foreach($allDogOwner as $dogOwner){
        if ($dogOwner["id_owner"] == $_SESSION["loggedInAsDogOwner"]) {
            $dog = $dogOwner["dog"];
        } 
    }
    $src =  $dog["image"];
    $dogName = $dog["dogName"];
    $dogBreed = $dog["breed"];
    $dogGender = $dog["gender"];
    $dogExtra = $dog["extraInfo"];
    ?>

    <div class="wrapper-profile">
        <h1>Välkommen <?php echo $ownerName ?>!</h1>
        <img class='profile-image'  alt='dog' src='../userImages/<?php echo $src; ?>'>
        <div class="wrapper-dog">
            <h2>Min hund</h2>
            <p><b>Namn:</b></p> <p id="margin"> <?php echo $dogName;?></p><br>
            <p><b>Ras:</b></p> <p id="margin">  <?php echo $dogBreed;?></p><br>
            <p><b>Kön:</b></p> <p id="margin"><?php echo $dogGender;?><br>
            <p><b>Behöver hundpassning:</b></p> <p id="margin"><?php echo $ownerDays;?></p><br>
            <p><b>Bra att veta:</b></p> <p id="margin"> <?php echo $dogExtra;?>
        </div>
        <div class="wrapper-contact">
            <h2>Kontaktuppgifter</h2>
            <p><b>Min mail:</b></p> <?php echo $ownerEmail;?> 
        </div>
        <div id="wrapper-owner">
            <h2>Om mig</h2>
            <p><b>Placering:</b></p>   
            <p id="margin"><?php echo $ownerLocation?> </p> 
            <br>
            <p><b>Jag betalar:</b></p>
            <p> <?php echo $ownerCost ?> /timme </p>
    </div>
    
    <button class="changeSettingsButton"> Ändra Uppgifter </button> 
    <button type="submit" class="delete-account-button">Radera Konto</button>
<?php
require_once __DIR__ . "/../section/footer.php";
?>


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

</div>
</body>
</html>