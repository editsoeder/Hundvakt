<?php 
error_reporting(-1);
session_start(); 
require_once "section/header.php";
require_once "functions.php";

// Kontrollera om "error" finns i vår URL
if (isset($_GET["error"])) {
    $error = $_GET["error"];

    // Felmeddelande
    if ($error == 1) {
        echo '<p class="error">Fill in all fields please</p>';
    } elseif ($error == 3) {
        echo '<p class="error">Wrong password </p>';
    } elseif ($error == 2) {
        echo '<p class="error">User does not exist </p>';
    }
}

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

                header("Location: dogowner/profile.php");
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


    <head>

	    <title>Logga In</title>
    </head>
    <body>
        <div class="logIn">
            <h2>Logga in</h2>

            <form class="form" action="sign-in.php" method="POST">
                <input type="email" name="email" placeholder="Email"><br>
                <input type="password" name="password" placeholder="Lösenord"><br>
                <button>Logga in</button> 
            </form>
        </div>

    </body>



<?php require_once "section/footer.php"; ?>