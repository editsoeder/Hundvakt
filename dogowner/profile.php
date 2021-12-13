<?php 
error_reporting(-1);

session_start();
require_once "../functions.php";
require_once "../section/header.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <title>Profile</title>
</head>

<body>

    <h1>Min Profil</h1>
    <div id="wrapper-dog"></div>
    <div id="wrapper-contact"></div>
    <div id="wrapper-owner"></div>

    <form action="/dogowner/update.php" method="POST">
        <button type="submit" class="button" id="change-settings">Ändra Uppgifter</button>
    </form>

    <form action="delete.php" method="POST">
        <button type="submit" class="button" id="delete-account">Radera Konto</button>
    </form>
</body>
<?php
require_once "../section/footer.php";



