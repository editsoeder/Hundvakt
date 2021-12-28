<?php
error_reporting(-1);
session_start();
require_once __DIR__ . "/../section/header.php";
require_once __DIR__ . "/../functions.php";
$loggedInID = $_SESSION["loggedInAsDogSitter"];
$sitterInfo = idInfoSitter($_SESSION["loggedInAsDogSitter"]);
$sitterFirstName = $sitterInfo["first_name"];
$sitterLastName = $sitterInfo["last_name"];
$sitterCost = $sitterInfo["cost"];
$sitterArea = implode(" ", $sitterInfo["areas"]);
$sitterDays = implode(" ", $sitterInfo["days"]);
$sitterLocation = $sitterInfo["location"];
$sitterEmail = $sitterInfo["email"];
$sitterExtra = $sitterInfo["extraInfo"];
$sitterPassword = $sitterInfo["password"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update your page</title>
</head>
<body>
<h1 class="h2-update" >Här kan du ändra din profil!</h1>
<div class="form">
    <form class="createAccountUpdate" action="create.php" method="POST" enctype="multipart/form-data">
        <div id="dogsitter"> 
            <p>Förnamn</p><input class="input-text" type="text" name="firstName" placeholder="<?php echo $sitterFirstName ?>"><br>
            <p>Efternamn</p><input type="text" name="lastName" placeholder="<?php echo $sitterLastName ?>"><br>
            <p>Email</p><input type="email" name="email" placeholder="<?php echo $sitterEmail ?>"><br>
            <p>Nytt Lösenord</p><input type="password" placeholder ="<?php echo $sitterPassword ?>"placeholder="Skriv Nytt Lösenord"<br>
            <p>Timkostnad</p><input type="text" name="cost" placeholder="<?php echo $sitterCost ?>"><p>kr/timm</p><br>
            <p>Bra att veta</p><input type="text" name="extraInfo" placeholder="<?php echo $sitterExtra ?>"> <br> <br>
            <div id="areaBoxUpdate">
            <?php
            createAreaBoxesUpdate();
            ?> 
        </div> 

        <div id="dayBoxUpdate"> 
            <h2 class="h2-update"> Dagar jag kan vakta </h2> 
            <?php 
            createDayBoxesUpdate();
            ?> 
        </div> 
        <div id="uploadImageUpdate"> 
            <h2 class="h2-update"> Ladda upp en ny profilbild </h2> 
            <input type="file" name="imageToUpload" id="fileToUpload">
        </div> 
        <button class="button">Updatera!</button>
        </div> 
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON("dogsitter.json");

$updateProfile = [ 
    "first_name" => $_POST["firstName"],
    "last_name" => $_POST["lastName"],
    "email" => $_POST["email"],
    "password" => $_POST["password"],
    "location" => $_POST["Placering"],
    "cost" => $_POST["Timkostnad"],
    "days" => $_POST["days"],
    "areas" => $_POST["areas"],
    "extraInfo" => $_POST["extraInfo"],
    "image" => $uniqueFilename.'.'.$extension //spara unika namnet på bilden som sökväg
    
];  
foreach($data as $user){
    if($loggedInID === $user["id"]){
       $user = $updateProfile;
    }
}
$json = json_encode($data);
file_put_contents("../dogsitter.json", $json);

    if(is_null($updateProfile ) ){
        echo "<p class 'feedbackMessage'> Något gick fel, försök igen </p>";
        exit();
    }

    if (empty($updateProfile ["first_name"]) || empty($updateProfile ["last_name"]) || empty($updateProfile ["email"]) || empty($updateProfile ["password"]) || empty($updateProfile ["location"]) || empty($updateProfile ["cost"]) || empty($updateProfile ["days"]) || empty($updateProfile ["areas"])|| empty($updateProfile ["extraInfo"])) {
        echo "<p class 'feedbackMessage'> Alla fält måste vara ifyllda, försök igen </p>";
        exit();
    }

    if(strlen($updateProfile ["password"]) < 4) {
        echo "<p class 'feedbackMessage'> Lösenord måste vara minst 4 tecken långt </p>";
        exit();       
    }



   

    updateProfileSitter("../dogsitter.json", $updateProfile);
    echo "<p class 'feedbackMessage'> Profil Uppdaterad!</p>";
   }
?>