<?php 
error_reporting(-1);
session_start();

if (!isset($_SESSION["loggedInAsDogOwner"])) {
    if(isset($_SESSION["loggedInAsDogSitter"])) {
        header("Location: ../dogsitter/read.php");
        exit();
    } else {
        header("Location: ../sign-in.php");
        exit();
    }
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alla hundvakter</title>
    <?php 
        require_once __DIR__ . "/../section/header2.php";
    ?> 
<!-- </head> stängs iställer i header.php-->
<body>
    <?php
    require_once __DIR__ . "/../functions.php";
    $allDogSitter = getAllDogSitter();

    //Inloggad
    if(isset($_SESSION["loggedInAsDogOwner"])) {
            
        // Om "id" finns i url
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            foreach($allDogSitter as $dogSitter){
                if ($dogSitter["id_sitter"] == $id) {
                    $foundDogSitter = $dogSitter; 
                } 
            }

            $days = implode(", ",$foundDogSitter["days"]);
            $areas = implode(", ",$foundDogSitter["areas"]);

            $src = '/Images/dogs.jpg';
            // $src = '/Images/puppy.jpg';
        
            //Mer info
            if (isset($foundDogSitter)) { 

                $div = "
                <img id='profileDog' src='$src' alt='Profil picture'>
                <div class='one'>
                    <div class='dogName'>{$foundDogSitter['first_name']}</div>
                    <div class='bold'>Tillgänglig i områden: <p>{$areas}</p></div>
                    <div class='bold'>Tillgänglig dagar: <p>{$days}</p></div>
                    <div class='bold'>Timkostnad: <p>{$foundDogSitter['cost']}</p></div>
                </div>

                <div class='two'>
                    <p class='bold'>Kontaktas via:</p>
                    <p>{$foundDogSitter['email']}</p>
                </div>

                <div class='three'>
                    <p class='bold'>Bra att veta:</p>
                    <p>{$foundDogSitter['extraInfo']}</p>
                </div>
                ";
                $content = "<div class='content'> $div</div>";
                echo $content;
            } 

        } elseif (!isset($_GET["id"])) {

            $filter = '<div id="filterOwner"></div>'; 

            $title = '
            <div class="dogSitter"> 
                    <div class="listTitle"> 
                        <div id="listName"> Namn</div>
                        <div id="listName"> Placering</div>
                        <div id="listName"> Dagar</div>
                        <div id="listName"> Timlön</div>
                    </div>
                    <div class="list"></div>
            </div>
            ';

            echo $filter; 
            echo $title;
            }
    }

    // Ej inloggad 
    elseif(!isset($_SESSION["loggedInAsDogOwner"])) {
        // header("Location: sign-out.php");
    }
    
    require_once __DIR__ . "/../section/footer.php"; ?>
</body>

</html>


<script src="read.js"></script>


