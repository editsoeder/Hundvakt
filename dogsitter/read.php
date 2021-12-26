<title>Alla hundar</title>

<?php 
error_reporting(-1);
session_start();
require_once __DIR__ . "/../section/header.php";
require_once __DIR__ . "/../functions.php";

$allDogOwner = getAllDogOwner();

//Om inloggad
if(isset($_SESSION["loggedInAsDogSitter"])) {

    //  Om "id" finns i url
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

       foreach($allDogOwner as $dogOwner){
            if ($dogOwner["id_owner"] == $id) {
                $foundDogOwner = $dogOwner; 
                $dog = $dogOwner["dog"];
            } 
        }

        $src = '/Images/dogs.jpg';
        // $src = '/Images/puppy.jpg';


        //Konvertera array till string
        $days = implode(", ",$foundDogOwner["days"]);

        if (isset($foundDogOwner)) { 
            $div = "
            <img id='profileDog' src='$src' alt='Dog profil picture'>
            <div class='one'>
                <div class='dogName'>{$dog['dogName']}</div>
                <div class='bold'>Ras: <p>{$dog['breed']}</p> </div>
                <div class='bold'>Kön: <p>{$dog['gender']}</p></div>
                <div class='bold'>Timkostnad: <p>{$foundDogOwner['cost']}</p></div>
                <div class='bold'>Placering: <p>{$foundDogOwner['location']}</p></div>
                <div class='bold'>Behöver hjälp: <p>{$days}</p></div>

            </div>

            <div class='two'>
                <p class='bold'>Kontaktas via:</p>
                <p>{$foundDogOwner['email']}</p>
            </div>

            <div class='three'>
                <p class='bold'>Bra att veta:</p>
                <p>{$dog['extra']}</p>
            </div>
            ";

            $content = "<div class='content'> $div</div>";
            echo $content;
            
        } 

    } elseif (!isset($_GET["id"])) {

        $filter = '<div id="filterSitter"></div>'; 

        $title = '
        <div class="dogOwner"> 
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
    elseif(!isset($_SESSION["loggedInAsDogSitter"])) {
    header("Location: sign-out.php");
}

?>

<script src="read.js"></script>

<?php 
require_once __DIR__ . "/../section/footer.php";
?>




