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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Min profil</title>
    <?php 
        require_once __DIR__ . "/../section/header2.php";
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

    if(isset($_SESSION["loggedInAsDogSitter"])) {

        //  Om "id" finns i url
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

        foreach($allDogOwner as $dogOwner){
                if ($dogOwner["id_owner"] == $id) {
                    $foundDogOwner = $dogOwner; 
                    $dog = $dogOwner["dog"];
                } 
            }
            $src = '../userImages/' . $dog["image"];
        }
    }

    ?>
    <div id="wrapper-profile">
        <h1>Välkommen <?php echo $ownerName ?>!</h1>
        <img id='profile-image' src= <?php echo $src?>>
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
        <p>Jag behöver hundpassning:<br> <?php echo $ownerDays?> </p>
        <p>Jag betalar: <?php echo $ownerCost ?> /timme </p>
        </div>
    </div>
        
    <form action="/dogowner/update.php" method="POST">
        <button type="submit" class="button" id="change-settings-button">Ändra Uppgifter</button>
    </form>


    <button type="submit" id="delete-account-button">Radera Konto</button>

    <script>

        document.querySelector("#delete-account-button").addEventListener("click", function () {

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



