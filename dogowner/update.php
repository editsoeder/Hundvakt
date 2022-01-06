<?php
error_reporting(-1);
session_start();

if (!isset($_SESSION["loggedInAsDogOwner"])) {
    if(isset($_SESSION["loggedInAsDogSitter"])) {
        header("Location: ../dogsitter/update.php");
        exit();
    } else {
        header("Location: ../sign-in.php");
        exit();
    }
}

require_once __DIR__ . "/../functions.php";
$loggedInID = $_SESSION["loggedInAsDogOwner"];
$ownerInfo = idInfoOwner($_SESSION["loggedInAsDogOwner"]);
$ownerFirstName = $ownerInfo["first_name"];
$ownerLastName = $ownerInfo["last_name"];
$ownerCost = $ownerInfo["cost"];
$ownerDays = $ownerInfo["days"];
$ownerLocation = $ownerInfo["location"];
$ownerEmail = $ownerInfo["email"];
$ownerPassword = $ownerInfo["password"];

$dogInfo = $ownerInfo["dog"];
$dogName = $dogInfo["dogName"];
$dogBreed = $dogInfo["breed"];
$dogExtra = $dogInfo["extraInfo"];
$dogGender = $dogInfo["gender"];
$dogImage = $dogInfo["image"];

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
                <p>Förnamn</p><input class="input-text" type="text" name="firstName" placeholder="<?php echo $ownerFirstName ?>" value ="<?php echo $ownerFirstName ?>"><br>
                <p>Efternamn</p><input type="text" name="lastName" placeholder="<?php echo $ownerLastName ?>" value="<?php echo $ownerLastName ?>"><br>
                <p>Email</p><input type="email" name="email" placeholder="<?php echo $ownerEmail ?>" value="<?php echo $ownerEmail ?>"><br>
                <p>Lösenord</p><input type="text" name="password" placeholder="Skriv Nytt Lösenord" value="<?php echo $ownerPassword ?>" minlength="4" required><br>
                
                <p>Timkostnad</p>
                <input list="hourCost" name="Timkostnad" placeholder="<?php echo $ownerCost ?>"value="<?php echo $ownerCost?>"><br>
                <datalist id="hourCost">
                    <option value="50">
                    <option value="60">
                    <option value="70">
                    <option value="80">
                    <option value="90">
                    <option value="100">
                </datalist>

                <h2 class="h2-update"> Min Placering </h2> 
                <input list="placement" name="Placering" placeholder="<?php echo $ownerLocation ?>" value="<?php echo $ownerLocation ?>"><br> 
                <datalist id="placement">
                    <option value="Fosie">
                    <option value="Husie">
                    <option value="Hyllie">
                    <option value="Kirseberg">
                    <option value="Limhamn-Bunkeflo">
                    <option value="Malmö Centrum">
                    <option value="Oxie">
                    <option value="Rosengård">
                    <option value="Södra Innerstaden">
                    <option value="Västra Innerstaden">
                </datalist>                    
            </div>
            
            <div id="dayBoxUpdate"> 
                <h2 class="h2-update"> Dagar jag kan vakta: </h2> 
                <div class="dayWrapperUpdate">  
                    <input class="input-update" type="checkbox" id="Monday" name="days[]" value="Måndag" <?php if(in_array("Måndag", $ownerInfo["days"])) { echo "checked";} ?> >
                    <label for="Monday"> Måndag </label>
                    <input class="input-update" type="checkbox" id="Tuesday" name="days[]" value="Tisdag" <?php if(in_array("Tisdag", $ownerInfo["days"])) { echo "checked";} ?> >
                    <label for="Tuesday"> Tisdag </label>
                    <input class="input-update" type="checkbox" id="Wednesday" name="days[]" value="Onsdag" <?php if(in_array("Onsdag", $ownerInfo["days"])) { echo "checked";} ?> >
                    <label for="Wednesday"> Onsdag </label>
                    <input class="input-update" type="checkbox" id="Thursday" name="days[]" value="Torsdag" <?php if(in_array("Torsdag", $ownerInfo["days"])) { echo "checked";} ?> >
                    <label for="Torsdag"> Torsdag </label>
                    <input class="input-update" type="checkbox" id="Friday" name="days[]" value="Fredag" <?php if(in_array("Fredag", $ownerInfo["days"])) { echo "checked";} ?> >
                    <label for="Friday"> Fredag </label>
                    <input class="input-update" type="checkbox" id="Saturday" name="days[]" value="Lördag" <?php if(in_array("Lördag", $ownerInfo["days"])) { echo "checked";} ?> >
                    <label for="Saturday"> Lördag </label>
                    <input class="input-update" type="checkbox" id="Sunday" name="days[]" value="Söndag" <?php if(in_array("Söndag", $ownerInfo["days"])) { echo "checked";} ?>>
                    <label for="Sunday"> Söndag </label>
                </div>  
            </div>
            <div id="updateDogInfo"> 
                <h2 class="h2-update"> Ändra information om hunden </h2> 
                <p>Hundens namn</p>
                <input type="text" name="dogName" placeholder="<?php echo $dogName ?>" value="<?php echo $dogName ?>"> <br> <br>
                <p>Hundens ras</p>
                <input type="text" name="dogBreed" placeholder="<?php echo $dogBreed ?>" value="<?php echo $dogBreed ?>"> <br> <br>
                <div id="genderDiv"> 
                    <p>Hundens kön</p>
                    <input type="checkbox" class="genderCheckbox" name="dogGender" value="Hona" <?php if(in_array("Hona", $dogInfo)) { echo "checked";} ?>>
                    <label for="Hona"> Hona </label><br>
                    <input type="checkbox" class="genderCheckbox"  name="dogGender" value="Hane" <?php if(in_array("Hane", $dogInfo)) { echo "checked";} ?>>
                    <label for="Hane"> Hane </label><br>                
                </div>
                <p>Bra att veta</p>
                <input type="text" name="extraInfo" placeholder="<?php echo $dogExtra ?>" value="<?php echo $dogExtra ?>"> <br> <br>
            </div> 

            <div class="uploadImageUpdate"> 
                <h2 class="h2-update"> Ladda upp en ny bild på hunden </h2> 
                <input type="file" name="newImageToUpload" id="fileToUpload">
            </div> 
            <div class="update-button-wrapper">
            <button type="submit" class="update-button">Spara</button>
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
    $data = loadJSON("dogowners.json");

    $imageUrl = $dogImage;
    $file = $_FILES["newImageToUpload"];

    if (isset($file) && $file["error"] != 4) {
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
        $imageUrl = $uniqueFilename.'.'.$extension;
    }

    $updateProfile = [
        "id_owner" => $loggedInID,
        "first_name" => $_POST["firstName"],
        "last_name" => $_POST["lastName"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "location" => $_POST["Placering"],
        "cost" => $_POST["Timkostnad"],
        "days" => $_POST["days"],
        "dog" => [
            "dogName" => $_POST["dogName"],
            "breed" => $_POST["dogBreed"],            
            "gender" => $_POST["dogGender"],
            "extraInfo" => $_POST["extraInfo"],
            "image" => $imageUrl //spara unika namnet på bilden som sökväg
        ]
    ]; 

    for ($i=0; $i < count($data); $i++) { 
        $currData = $data[$i];
        $currUser = $currData["id_owner"];
        if($loggedInID === $currUser){
            $data[$i] = $updateProfile;
        }
    }

    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/../dogowner/dogowners.json", $json);


// updateUser("dogsitter.json", $updateProfile);
    // updateProfileSitter("../dogsitter.json", $updateProfile);
    echo "<p class 'feedbackMessageUpdate'> Profil uppdaterad!</p>";
   }
?>



