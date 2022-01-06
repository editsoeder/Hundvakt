<?php 
error_reporting(-1);
session_start(); 
require_once "section/header.php";

?> 
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

