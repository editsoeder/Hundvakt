<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    	<link rel="stylesheet" href="style.css">
	    <title>Startsida</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    </head>
    <body>
        <main class="homePage">
            <div class="partOne">
                <div class="homePageTitle">Välkommen till</div>
                <div class="homePageTitle">Dog-go</div>
                <div class="homePageImgOne"></div>
                <div class="homePageImgTwo"></div>
                <button class="homePagebuttonOne">Skapa konto</button>
                <button class="homePagebuttonTwo">Logga in</button>
            </div>

            <div class="partTwo">
                <div id="first">
                    <div>Vad är Dog-go?</div>
                    <div>Dog-Go är hemsidan där hundälskare i Malmö möts. Genom vår smarta matchnings-funktion kan du som hundägare hitta hundvakter som passar just dina behov. På samma sätt kan du som vill vakta hundar scrolla bland våra många härliga hundar och hitta en hund att passa som matchar dina önskemål om timkostnad, placering och dagar. <br> <br> Vad väntar du på? Gör som många andra nöjda Malmöiter och skapa ett konto redan idag! </div>
                    <button class="homePagebuttonThree">Skapa konto</button>
                </div>

                <div id="second">
                    <div class="homePageImgThree"></div> 
                </div>
            </div>
        </main>
        <script>
            document.querySelector(".homePagebuttonTwo").addEventListener("click", function () {
                window.location.href = "sign-in.php";
            });

            document.querySelector(".homePagebuttonOne").addEventListener("click", function () {
                window.location.href = "createAs.php";
            });

            document.querySelector(".homePagebuttonThree").addEventListener("click", function () {
                window.location.href = "createAs.php";
            });
        </script>
    </body>
</html>

<?php 
require_once __DIR__ . "/section/footer.php";
?>