<?php 
error_reporting(-1);
session_start();
require_once __DIR__ . "/../functions.php";
require_once __DIR__ . "/../section/header.php";


$allDogOwner = getAllDogOwner();

//Inloggad
if(isset($_SESSION["loggedInAsDogOwner"])) {
          
    // Om "id" finns i url
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        foreach($allDogOwner as $dogOwner){
            if ($dogOwner["id_owner"] == $id) {
                $foundDogOwner = $dogOwner; 
                $dog = $dogOwner["dog"];
            } 
        }

    $days = implode(" ",$dogOwner["days"]);

    //Mer info
    if (isset($foundDogOwner)) { 
        $div = "
        <div class='one'>
            <img src='' alt='Profil picture'>
            <p>{$dog['dogName']}</p>
            <p>Ras:{$dog['breed']}</p>
            <p>Kön:{$dog['gender']}</p>
            <p>Timkostnad: {$dogOwner['cost']}</p>
            <p>Placering: {$dogOwner['location']}</p>
            <p>Behöver hjälp: {$days}</p>

        </div>

        <div class='two'>
            <p>Kontaktas via:</p>
            <p>{$foundDogOwner['email']}</p>
        </div>

        <div class='three'>
            <p>Bra att veta:</p>
            <p>{$dog['extra']}</p>
        </div>
        ";
        echo $div;
    } 

} elseif (!isset($_GET["id"])) {

    $filter = '<div id="filter"></div>'; 

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
    header("Location: sign-out.php");
}?>

<script src="read.js"></script>

<?php require_once __DIR__ . "/../section/footer.php"; ?>

