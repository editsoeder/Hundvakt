<?php
error_reporting(-1);
session_start();

if (!isset($_SESSION["loggedInAsDogSitter"])) {
    if(isset($_SESSION["loggedInAsDogOwner"])) {
        header("Location: ../dogowner/update.php");
        exit();
    } else {
        header("Location: ../sign-in.php");
        exit();
    }
}

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
    <title>Ändra uppgifter</title>
    <?php 
    require_once __DIR__ . "/../section/header2.php";
    ?> 
<!-- </head> stängs i header.php -->
<body>
    <h1 class="h2-update" >Här kan du ändra din profil!</h1>
    <div class="form">
        <form class="update-account" action="update.php" method="POST" enctype="multipart/form-data">
            <div id="dogsitter-form"> 
                <p>Förnamn</p><input class="input-text" type="text" name="firstName" placeholder="<?php echo $sitterFirstName ?>" value ="<?php echo $sitterFirstName ?>">><br>
                <p>Efternamn</p><input type="text" name="lastName" placeholder="<?php echo $sitterLastName ?>" value="<?php echo $sitterLastName ?>"><br>
                <p>Email</p><input type="email" name="email" placeholder="<?php echo $sitterEmail ?>" value="<?php echo $sitterEmail ?>"><br>
                <p>Lösenord</p><input type="password" name="password" placeholder="Skriv Nytt Lösenord" value="<?php echo $sitterPassword ?>" minlength="8" required><br>
                <p>Timkostnad</p><input type="text" name="cost" placeholder="<?php echo $sitterCost ?>" value="<?php echo $sitterCost ?>"><p>kr/timm</p><br>
                <p>Bra att veta</p><input type="text" name="extraInfo" placeholder="<?php echo $sitterExtra ?>" value="<?php echo $sitterExtra ?>"> <br> <br>
                <div id="areaBoxUpdate">
                    <?php
                    createAreaBoxesUpdate();
                    ?> 
                    <h2 class="h2-update"> Min Placering </h2> 
                    <?php
                    createLocationList();
                    ?>
                </div>
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
            <div id=update-button-wrapper>
                <button id="update-button">Updatera!</button>
            </div>
        </form>
    </div> 

    <?php 
    require_once __DIR__ . "/../section/footer.php";
    ?> 
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON("dogsitter.json");

    if (isset($_FILES["imageToUpload"])) {
        $file = $_FILES["imageToUpload"];
        $filename = $file["name"];
        $tempname = $file["tmp_name"];
        $uniqueFilename = sha1(time().$filename);
        $size = $file["size"];

        if ($size > 4 * 1000 * 1000) {
            echo "Filen får inte vara större än 4mb";
            exit();
        }

        //Hämta filinformation & kolla vilken filtyp det är
        $info = pathinfo($filename);
        $extension = strtolower($info["extension"]);
        //Spara bilden med unikt namn i mappen "userImages"
        move_uploaded_file($tempname, __DIR__ . "/../userImages/$uniqueFilename.$extension");
    }

$updateProfile = [
    "id_sitter" => $loggedInID,
    "first_name" => $_POST["firstName"],
    "last_name" => $_POST["lastName"],
    "email" => $_POST["email"],
    "password" => $_POST["password"],
    "location" => $_POST["Placering"],
    "cost" => $_POST["cost"],
    "days" => $_POST["days"],
    "areas" => $_POST["areas"],
    "extraInfo" => $_POST["extraInfo"],
    "image" => $uniqueFilename.'.'.$extension //spara unika namnet på bilden som sökväg
]; 

// foreach($updateProfile as [$value=>$key]){
//     $user = $data[$index];
//     $user[$key] = $value;
// }
// foreach($data as $user){
//     if($loggedInID === $user["id_sitter"]){
//        $user = $updateProfile;
//     }
// }

$column = array_column($data, "id_sitter");
$index = array_search($loggedInID, $column);
$user = $data[$index];
$user = $updateProfile;

foreach($data as $user){
    if($loggedInID === $user["id_sitter"]){
       $user = $updateProfile;
    }
} 
// if(is_null($updateProfile ) ){
//     echo "<p class 'feedbackMessageUpdate'> Något gick fel, försök igen </p>";
//     exit();
// }

// if (empty($updateProfile ["first_name"]) || empty($updateProfile ["last_name"]) || empty($updateProfile ["email"]) || empty($updateProfile ["password"]) || empty($updateProfile ["location"]) || empty($updateProfile ["cost"]) || empty($updateProfile ["days"]) || empty($updateProfile ["areas"])|| empty($updateProfile ["extraInfo"])) {
//     echo "<p class 'feedbackMessageUpdate'> Alla fält måste vara ifyllda, försök igen </p>";
//     exit();
// }

// if(strlen($updateProfile ["password"]) < 4) {
//     echo "<p class 'feedbackMessageUpdate'> Lösenord måste vara minst 4 tecken långt </p>";
//     exit();       
// }
// if ($size > 4 * 1000 * 1000) {
//     echo "Filen får inte vara större än 4mb";
//     exit();
// }

$json = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents("dogsitter.json", $json);




// updateUser("dogsitter.json", $updateProfile);
    // updateProfileSitter("../dogsitter.json", $updateProfile);
    echo "<p class 'feedbackMessageUpdate'> Profil Uppdaterad!</p>";
   }
?>
