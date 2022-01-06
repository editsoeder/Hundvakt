<?php 
error_reporting(-1);
session_start(); 
// require_once "section/header.php";
require_once __DIR__ . "/functions.php";

$dogSitter = json_decode(file_get_contents("dogsitter/dogsitter.json"), true);
$dogOwner = json_decode(file_get_contents("dogowner/dogowners.json"), true);


//Om email och password skickas med från sign-in.php
if (isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
 // Om något av fälten är tomma, skicka tillbaka med error=1
    if ($email === "" || $password === "") {
        header("Location: sign-in.php?error=1");
        exit();
    }  

    foreach ($dogOwner as $user) {

        if ($user["email"] === $email && $user["password"] === $password) {
            if (isset($user["id_owner"])) {

                // Spara user id i session
                $_SESSION["loggedInAsDogOwner"] = $user["id_owner"];

                // Representerar att användare är inloggad
                $_SESSION["loggedIn"] = true;

                header("Location: ../dogowner/profile.php");
                exit();
            } 
        }

        elseif ($user["email"] === $email) {
            header("Location: sign-in.php?error=3");
            exit();
        }
    }

    foreach ($dogSitter as $sitter) {

        if ($sitter["email"] === $email && $sitter["password"] === $password) {
            if (isset($sitter["id_sitter"])) {

                // Spara user id i session
                 $_SESSION["loggedInAsDogSitter"] = $sitter["id_sitter"];

                 // Representerar att användare är inloggad
                $_SESSION["loggedIn"] = true;

                header("Location: dogsitter/profile.php");
                exit();
            } 
        }

        elseif ($sitter["email"] === $email) {
            header("Location: sign-in.php?error=3");
            exit();
        }
    }

    header("Location: sign-in.php?error=2");
    exit();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logga in</title>
    <?php require_once "section/header.php";?> 

<!-- </head> stängs i header-->
<body>
    <div class="logIn">
        <svg id="svg-sprite">
        <symbol id="paw" viewBox="0 0 249 209.32">
            <ellipse cx="27.917" cy="106.333" stroke-width="0" rx="27.917" ry="35.833"/>
            <ellipse cx="84.75" cy="47.749" stroke-width="0" rx="34.75" ry="47.751"/>
            <ellipse cx="162" cy="47.749" stroke-width="0" rx="34.75" ry="47.751"/>
            <ellipse cx="221.083" cy="106.333" stroke-width="0" rx="27.917" ry="35.833"/>
            <path stroke-width="0" d="M43.98 165.39s9.76-63.072 76.838-64.574c0 0 71.082-6.758 83.096 70.33 0 0 2.586 19.855-12.54 31.855 0 0-15.75 17.75-43.75-6.25 0 0-7.124-8.374-24.624-7.874 0 0-12.75-.125-21.5 6.625 0 0-16.375 18.376-37.75 12.75 0 0-28.29-7.72-19.77-42.86z"/>
        </symbol>
        </svg>

        <div class="ajax-loader">
            <div class="paw"><svg class="icon"><use xlink:href="#paw" /></svg></div>
            <div class="paw"><svg class="icon"><use xlink:href="#paw" /></svg></div>
            <div class="paw"><svg class="icon"><use xlink:href="#paw" /></svg></div>
            <div class="paw"><svg class="icon"><use xlink:href="#paw" /></svg></div>
            <div class="paw"><svg class="icon"><use xlink:href="#paw" /></svg></div>
            <div class="paw"><svg class="icon"><use xlink:href="#paw" /></svg></div>
        </div>

        <div class="back"><button class="backToHome">Hem</button ></div>
        
        <div class="logInText">
            <?php // Kontrollera om "error" finns i vår URL
            if (isset($_GET["error"])) {
                $error = $_GET["error"];

                // Felmeddelande
                if ($error == 1) {
                    echo '<p class="error">Alla fält måste vara ifyllda, testa igen.</p>';
                } elseif ($error == 3) {
                    echo '<p class="error">Fel lösenord, testa igen.</p>';
                } elseif ($error == 2) {
                    echo '<p class="error">Användaren finns inte, testa igen.</p>';
                }
            } else {
                echo '<p>Logga in</p>';
            } ?> 
        </div>
            

        <form class="form" action="sign-in.php" method="POST">
            <input class="logInInput" type="email" name="email" placeholder="Email"><br>
            <input class="logInInput" type="password" name="password" placeholder="Lösenord"><br>
            <button class="logInBtn">Logga in</button> 
        </form>

        <div class="createAc">Har du inget konto? </div>
        <a href="createAs.php" class="createAcBold">Registrera dig</a>
        
        <script src="sign-in.js"></script>
    </div>
        
    <?php require_once __DIR__ . "/section/footer.php"; ?>
</body>
</html>