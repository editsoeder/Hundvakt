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
<div id="wrapper-profile">
    <h1>Min Profil</h1>
    <div id="wrapper-dog"></div>
    <div id="wrapper-contact"></div>
    <div id="wrapper-owner"></div>
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