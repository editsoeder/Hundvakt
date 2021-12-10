<?php 
error_reporting(-1);
session_start();
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
    <nav>
        <a href="sign-out.php">Sign out</a> 
    </nav>

<h1>Min Profil</h1>
<div id="wrapper-dog"></div>
<div id="wrapper-contact"></div>
<div id="wrapper-owner"></div>
<button class="button" id="change-settings">Ändra Uppgifter</button>
<button class="button" id="delete-account">Radera Konto</button>

<script>
document.querySelector(".change-settings").addEventlistner('click', function(){
    <?php
    header("Location: update.php");
    ?>
})
document.querySelector(".delete-account").addEventlistner('click', function(){
    <?php
    header("Location: delete.php");
    ?>
})
</script>
</body>

<?php
require_once "../section/footer.php";
require_once "../functions.php";
?>