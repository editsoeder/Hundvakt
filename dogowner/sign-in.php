<?php 
session_start(); 
require_once "../section/header.php";

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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    	<link rel="stylesheet" href="../style.css">
	    <title>Logga In</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="form">
            <h2>Logga in</h2>

            <form class="logIn" action="profile.php" method="POST">
                <input type="email" name="email" placeholder="Email"><br>
                <input type="password" name="password" placeholder="Lösenord"><br>
                <button>Logga in</button> 
            </form>
        </div>

    </body>
</html>


<?php require_once "../section/footer.php"; ?>