<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>List of all dogsitters</title>
</head>

<?php 
error_reporting(-1);
session_start();
require_once "../section/header.php";
require_once "../functions.php";
require_once "../section/footer.php";

$allDogSitter = getAllDogSitter();
foreach ($allDogSitter as $dogSitter) {
        $DS = $dogSitter;
        
}
?>

<body>
    <nav class="nav"></nav>

    <!-- <script>
        let array = '<?php  $allDogSitter; ?>';
        const obj = JSON.parse(array);
        console.log(obj);


    </script>  -->


    <!-- <?php
        $myVariable = 'a testing variable';
    ?>
    <script type='text/javascript'>
        var fromTheServer = '<?php echo $myVariable; ?>';
        console.log(fromTheServer);
    </script>  -->



<?php


$days = implode(" ",$DS["days"]);
$areas = implode(" ",$DS["areas"]);

//Om inloggad! FIXA SEN
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
        <select name="days" multiple="multiple" id="days" >
        <option value="Måndag">Måndag</option>
        <option value="Tisdag">Tisdag</option>
        <option value="Onsdag">Onsdag</option>
        <option value="Torsdag">Torsdag</option>
        <option value="Fredag">Fredag</option>
        </select>

        <input type="submit" value="Filtrera"><br>
    </form>';
    $f = '
    <form style="text-align:center;" method="get" action="read.php">
        <select name="days" id="days" >
        <option value="Måndag">Måndag</option>
        <option value="Tisdag">Tisdag</option>
        <option value="Onsdag">Onsdag</option>
        <option value="Torsdag">Torsdag</option>
        <option value="Fredag">Fredag</option>
        </select>

        <input type="submit" value="Filtrera"><br>
    </form>';
    echo $filter;
    echo $f;


    if (isset($_GET["days"])) {
        echo $_GET["days"];
    }

    // if (!isset($_GET["days"])) {
        
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

    foreach($allDogSitter as $dogSitter){
        echo showOneDog($dogSitter);
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