<?php 
session_start(); 
require_once "../section/header.php";
include "../functions.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    	<link rel="stylesheet" href="../style.css">
	    <title>Skapa konto</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="welcomemessage"> 
            <h2> Vad kul att du vill bli hundvakt!</h2>  
            <p> Vänligen fyll i fälten nedan. </p>
        </div> 
        <div class="form">
            <h2>Skapa konto</h2>
            <form class="createAccount" action="../functions.php" method="POST">
                <input type="text" name="firstName" placeholder="Förnamn"><br>
                <input type="text" name="lastName" placeholder="Efternamn"><br>
                <input type="email" name="email" placeholder="E-postadress"><br>
                <input type="password" name="password" placeholder="Lösenord"><br>

                <?php 
                createLocationList();
                createDayList();
                createAreaBoxes();
                createDayBoxes();
                ?> 
                <button>Skapa konto</button> 
            </form>
        </div>
    </body>
</html>

<?php 

$dogsitters = getJSON("dogsitter.json");

?>
<?php require_once "../section/footer.php"; ?>