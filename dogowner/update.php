<?php
session_start();
if (!isset($_SESSION["loggedInAsDogOwner"])) {
    if(isset($_SESSION["loggedInAsDogSitter"])) {
        header("Location: ../dogsitter/update.php");
        exit();
    } else {
        header("Location: ../sign-in.php");
        exit();
    }
}

?> 