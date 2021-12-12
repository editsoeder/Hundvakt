<?php
error_reporting(-1);
session_start();

if (isset($_SESSION["id_sitter"])) {
    unset($_SESSION["id_sitter"]);
}

if (isset($_SESSION["id_owner"])) {
    unset($_SESSION["id_owner"]);
}

unset($_SESSION["loggedInAsDogOwner"]);
unset($_SESSION["loggedInAsDogSitter"]);

session_destroy();

header("Location: sign-in.php");

exit();
?>
