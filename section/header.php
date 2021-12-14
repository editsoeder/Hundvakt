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
            <a href="/dogowner/read.php" >Hundvakter</a>
            <a href/dogowner/profile.php" >Profil</a>
            <a href="../sign-out.php" >Logga Ut</a>
            </nav>';
        }
        if (isset($_SESSION["loggedInAsDogSitter"])){
            echo '<nav>
            <a href="/dogsitter/read.php" >Hundar</a>
            <a href="/dogsitter/profile.php" >Profil</a>
            <a href="../sign-out.php" >Logga Ut</a>
            </nav>';  
        } else {
           
        }
?>
</main>
</body>