<?php 
error_reporting(-1);
session_start();
require_once __DIR__ . "/../functions.php";
require_once __DIR__ . "/../section/header.php";

$ownerInfo = idInfoOwner($_SESSION["loggedInAsDogOwner"]);
$ownerName = $ownerInfo["first_name"] . " " . $ownerInfo["last_name"];
$ownerLocation = $ownerInfo["location"];
$ownerDog = implode(" ", $ownerInfo["dog"]);
$ownerDays = implode(" ", $ownerInfo["days"]);
$ownerLocation = $ownerInfo["location"];
$ownerCost = $ownerInfo["cost"];
$ownerDogInfo = $ownerInfo["dog"];
$ownerEmail = $ownerInfo["email"];
// foreach($ownerInfo["dog"] as $dogs){
//    $dogs = $dog["dogName"];
// }
?>

<title>Profile</title>

<div id="wrapper-profile">
    <h1>Välkommen <?php echo $ownerName ?>!</h1>
    <div id="profile-image"></div>
    <div id="profile-image-dog"></div>
    <div id="wrapper-dog">
    <h2>Min hund</h2><p>Namn: <?php echo $ownerDog?> </p>
    </div>
    <div id="wrapper-contact">
    <h2>Kontaktuppgifter</h2>
    <p>Min mail är: <?php echo $ownerEmail?> </p>
    </div>  
    </div>
    <div id="wrapper-owner">
    <h2>Om mig</h2>
    <p>Mitt namn är: <?php echo $ownerName?> </p>
    <p>Jag bor i <?php echo $ownerLocation?> </p>
    <p>Jag behöver hundpassning: <?php echo $ownerDays?> </p>
    <p>Jag betalar: <?php echo $ownerCost ?> /timme </p>
    </div>
</div>
    <form action="/dogowner/update.php" method="POST">
        <button type="submit" class="button" id="change-settings-button">Ändra Uppgifter</button>
    </form>

    <form action="delete.php" method="DELETE">
        <button type="submit" class="button" id="delete-account-button">Radera Konto</button>
    </form>

<?php
require_once __DIR__ . "/../section/footer.php";
?>



