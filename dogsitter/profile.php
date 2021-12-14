<?php 
error_reporting(-1);

session_start();
require_once "../functions.php";
require_once "../section/header.php";

$sitterInfo = idInfoSitter($_SESSION["loggedInAsDogSitter"]);
$sitterName = $sitterInfo["first_name"] . " " . $sitterInfo["last_name"];
$sitterCost = $sitterInfo["cost"];
$sitterArea = implode(" ", $sitterInfo["areas"]);
$sitterDays = implode(" ", $sitterInfo["days"]);
$sitterLocation = $sitterInfo["location"];
$sitterEmail = $sitterInfo["email"];
$sitterExtra = $sitterInfo["extra_info"];


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <title>Profile</title>
</head>

<body>
<div id="wrapper-profile">
    <h1>Välkommen <?php echo $sitterName ?>!</h1>
    <div id="wrapper-info">
    <p>Jag befinner mig: <?php echo $sitterLocation ?> </p>
    <p>Jag passar hundar i: <?php echo $sitterArea?> </p>
    <p>Jag kan passa hundar på : <?php echo $sitterDays?> </p>
    <p>Min timlön är: <?php echo $sitterCost?> kr/tim </p>
    </div>
    <div id="wrapper-contact">
        <p> <?php echo $sitterName ?> </p>
        <p> <?php echo $sitterEmail ?> </p>
    </div>
    <div id="wrapper-extra_info">
    <p>Bra att veta om mig är:<?php echo $sitterExtra?> </p> 
    </div>
</div>
    <form action="/dogowner/update.php" method="POST">
        <button type="submit" class="button" id="change-settings-button">Ändra Uppgifter</button>
    </form>

    <form action="delete.php" method="POST">
        <button type="submit" class="button" id="delete-account-button">Radera Konto</button>
    </form>
</body>
<?php
require_once "../section/footer.php";
?>