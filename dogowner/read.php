<head>
    <title>Lista på alla hundar</title>
    
</head>

<?php 
error_reporting(-1);
session_start();
require_once "functions.php";
require_once 'section/header.php';

$allDogOwner = getAllDogOwner();

?>


<body>




<?php


//Om inloggad! FIXA SEN
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

    $filter = '
    <form style="text-align:center;" method="get" action="read.php">
        <select name="days" multiple="multiple" id="days" >
        <option value="Måndag">Måndag</option>
        <option value="Tisdag">Tisdag</option>
        <option value="Onsdag">Onsdag</option>
        <option value="Torsdag">Torsdag</option>
        <option value="Fredag">Fredag</option>
        </select>

        <input type="submit" value="Filtrera"><br>
    </form>';
    // echo $filter;


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
    echo $title;

    foreach($allDogOwner as $dogOwner){
        $ownersDog = $dogOwner["dog"];
        echo showDogs($dogOwner, $ownersDog);
    }
    
}

//FIXA SEN
    //Inloggad
    // if(isset($_SESSION["loggedInAsDogSitter"])) {
 
    // }

    // Ej inloggad 
    //  if(!isset($_SESSION["loggedInAsDogSitter"])) {
    //     header("Location: sign-out.php");
    // }

?>
</body>
</html>


<?php
require_once "section/footer.php";


?>