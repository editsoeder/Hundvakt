<?php 
error_reporting(-1);
session_start(); 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skapa konto som</title>
    <?php require_once "section/header.php"; ?> 
<!-- </head> stängs i header -->
<body>
    <div id="createAsWrapper">
        <button class="backToHomeCreateAs">Hem</button >
        <div id="contentWrapper">
            <h2> Vill du skapa konto som... </h2> 
            <div id="buttonsDiv"> 
                <button class="dogOwnerButton"> Hundägare </button> 
                <p> eller </p> 
                <button class="dogSitterButton"> Hundvakt </button> 
            </div>
        </div> 
    </div> 

    <script> 
        document.querySelector(".dogSitterButton").addEventListener("click", function() {
            window.location.href = "dogsitter/create.php";
        });

        document.querySelector(".dogOwnerButton").addEventListener("click", function() {
            window.location.href = "dogowner/create.php";
        });

        document.querySelector(".backToHomeCreateAs").addEventListener("click", function() {
            window.location.href = "index.php";
        });
    </script>
    
    <?php
    require_once "section/footer.php"; 
    ?>
</body>
</html>

