<?php 
error_reporting(-1);
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alla hundvakter</title>
    <?php 
        require_once __DIR__ . "/../section/header.php";
    ?> 
<!-- </head> stängs iställer i header.php-->
<body class="readBodyOwner">
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

                $src = '../userImages/' . $foundDogSitter["image"];
            
                //Mer info
                if (isset($foundDogSitter)) { 

                    $div = "
                    <img id='profileDog' src='$src' alt='Profil picture'>
                    <div class='one'>
                        <div class='dogName'>{$foundDogSitter['first_name']}</div>
                        <div class='bold'>Jag passar hundar i: <p>{$areas}</p></div>
                        <div class='bold'>Dagar jag kan passa: <p>{$days}</p></div>
                        <div class='bold'>Min timlön är: <p>{$foundDogSitter['cost']} kr/tim</p></div>
                    </div>

                    <div class='two'>
                        <p class='bold'>Min mail är:</p>
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
            header("Location: ../sign-out.php");
        } else {
            header("Location: ../sign-out.php");
        }
        
        require_once __DIR__ . "/../section/footer.php"; 
    ?>
</body>
</html>
<script src="read.js"></script>