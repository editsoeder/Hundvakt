<?php
error_reporting(-1);
session_start();
require_once "../section/header.php";
require_once "../functions.php";
require_once "../section/footer.php";

?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>List of all dogsitters</title>
</head>

<body>
    <nav class="nav"></nav>
</body>
</html>

<?php 

$allDogSitter = getAllDogSitter();
foreach($allDogSitter as $dogSitter){
        $DS = $dogSitter;
    }

$days = implode(" ",$DS["days"]);
$areas = implode(" ",$DS["areas"]);

//Om inloggad!
// Om "id" finns i url
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    foreach($allDogSitter as $dogSitter){
        if ($dogSitter["id_sitter"] == $id) {
            $foundDogSitter = $dogSitter; 
        } 
    }

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

    $filter = '
    <form style="text-align:center;" method="get" action="read.php">
        <select name="field">
        <option value="Måndag">Måndag</option>
        <option value="Tisdag">Tisdag</option>
        <option value="Onsdag">Onsdag</option>
        </select>

        <input type="submit" value="Filtrera"><br>
    </form>';
    echo $filter;

    // if (  isset($_GET["field"])) {

    //     $filter = $allDogSitter.filter(obj => obj.studentName == "David");
    //     console.log(result);
    //     $div = "
    //         <div class='listCard'>
    //             <p>{$days["måndag"]}</p>
    //         </div>
    //      ";
    //      echo $div;
    //      echo $_GET["field"]; 
    // }

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

    // foreach($allDogSitter as $dogSitter){
    //     echo showOneDog($dogSitter);
    // }
}


    //Inloggad
    // if(isset($_SESSION["loggedInAsDogSitter"])) {
 
    // }

    // Ej inloggad 
    //  if(!isset($_SESSION["loggedInAsDogSitter"])) {
    //     header("Location: sign-out.php");
    // }

?>