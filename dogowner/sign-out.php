<?php
error_reporting(-1);
session_start();

if (isset($_SESSION["id_sitter"])) {
    unset($_SESSION["id_sitter"]);
}

unset($_SESSION["loggedInAsDogOwner"]);
session_destroy();

header("Location: sign-in.php");

exit();
?>
