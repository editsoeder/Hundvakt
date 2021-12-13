<?php

// require_once "../functions.php";
// error_reporting(-1);
        //Om personen är inloggad så kommer nav visa alla länkar annars bara de tre väsentliga
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>


<body>
    <main>
        <header>
            <div id="header-image"></div>
        </header>

<?php
        if (isset($_SESSION["loggedInAsDogOwner"])) {
            echo '<nav>
            <a href="/dogowner/profile.php" >Hundvakter</a>
            <a href/dogownerread.php" >Profil</a>
            <a href="../sign-out.php" >Logga Ut</a>
            </nav>';
        }
        if (isset($_SESSION["loggedInAsDogSitter"])){
            echo '<nav>
            <a href="/dogsitter/profile.php" >Hundar</a>
            <a href="/dogsitter/read.php" >Profil</a>
            <a href="../sign-out.php" >Logga Ut</a>
            </nav>';  
        } else {
            echo '<nav></nav>';
        }
?>
</main>
</body>