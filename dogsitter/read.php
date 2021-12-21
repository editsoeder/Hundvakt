

<title>Lista på alla hundvakter</title>

<?php 
error_reporting(-1);
session_start();
require_once __DIR__ . "/../section/header.php";
require_once __DIR__ . "/../functions.php";

$allDogSitter = getAllDogSitter();

//Om inloggad
if(isset($_SESSION["loggedInAsDogSitter"])) {

    //  Om "id" finns i url
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        foreach($allDogSitter as $dogSitter){
            if ($dogSitter["id_sitter"] == $id) {
                $foundDogSitter = $dogSitter; 
            } 
        }

        $days = implode(" ",$foundDogSitter["days"]);
        $areas = implode(" ",$foundDogSitter["areas"]);

        //Konvertera array till string
        $days = implode(" ",$foundDogSitter["days"]);
        $areas = implode(" ",$foundDogSitter["areas"]);

        if (isset($foundDogSitter)) { 
            $div = "
            <div class='one'>
                <img src='' alt='Profil picture'>
                <p>{$foundDogSitter['first_name']}</p>
                <p>Tillgänglig i områden: {$areas}</p>
                <p>Tillgänglig dagar: {$days}</p>
                <p>Timkostnad: {$foundDogSitter['cost']}</p>
            </div>

            <div class='two'>
                <p>Kontaktas via:</p>
                <p>{$foundDogSitter['email']}</p>
            </div>

            <div class='three'>
                <p>Bra att veta:</p>
                <p>{$foundDogSitter['extra_info']}</p>
            </div>
            ";
            echo $div;
        } 

    } elseif (!isset($_GET["id"])) {

        $filter = '<div id="filter"></div>'; 

        $title = '
        <div class="dogSitter"> 
            <div class="list">
                <div class="listTitle"> 
                    <div id="listName"> Namn</div>
                    <div id="listName"> Placering</div>
                    <div id="listName"> Dagar</div>
                    <div id="listName"> Timlön</div>
                </div>
            
            </div>
        </div>
        ';

        echo $filter; 
        echo $title;

        // foreach($allDogSitter as $dogSitter){
        //     echo showDogSitter($dogSitter);
        // }
    }
}

    // Ej inloggad 
     elseif(!isset($_SESSION["loggedInAsDogSitter"])) {
        header("Location: sign-out.php");
    }

?>

<script src="read.js"></script>

<?php 
require_once __DIR__ . "/../section/footer.php";
?>