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
$sitterImage = $sitterInfo["image"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ändra uppgifter</title>
    <?php 
    require_once __DIR__ . "/../section/header.php";
    ?> 
<!-- </head> stängs i header.php -->
<body>
    <h1 class="h2-update" >Här kan du ändra din profil!</h1>
    <div class="form">
        <form class="update-account" action="update.php" method="POST" enctype="multipart/form-data">
            <div id="dogsitter-form"> 
                <p>Förnamn</p><input class="updateFields" type="text" name="firstName" placeholder="<?php echo $sitterFirstName ?>" value ="<?php echo $sitterFirstName ?>"><br>
                <p>Efternamn</p><input type="text" class="updateFields" name="lastName" placeholder="<?php echo $sitterLastName ?>" value="<?php echo $sitterLastName ?>"><br>
                <p>Email</p><input type="email" class="updateFields" name="email" placeholder="<?php echo $sitterEmail ?>" value="<?php echo $sitterEmail ?>"><br>
                <p>Lösenord</p><input type="text" class="updateFields" name="password" placeholder="Skriv Nytt Lösenord" value="<?php echo $sitterPassword ?>" minlength="4" required><br>
                
                <p>Timkostnad</p>
                <select name="Timkostnad" id="Cost" class="selectList">
                    <option value="50" <?php if($sitterCost == "50") { echo "selected"; }?> >50</option>
                    <option value="60" <?php if($sitterCost == "60") { echo "selected"; }?> >60</option>
                    <option value="70" <?php if($sitterCost == "70") { echo "selected"; }?> >70</option>
                    <option value="80" <?php if($sitterCost == "80") { echo "selected"; }?> >80</option>
                    <option value="90" <?php if($sitterCost == "90") { echo "selected"; }?> >90</option>
                    <option value="100" <?php if($sitterCost == "100") { echo "selected"; }?> >100</option>
                </select>

                <p>Bra att veta</p><input type="text" id="updateFieldExtra" name="extraInfo" placeholder="<?php echo $sitterExtra ?>" value="<?php echo $sitterExtra ?>"> <br> <br>
                
                <p> Min Placering </p> 
                <select name="Placering" id="Placering" class="selectList">
                    <option value="Fosie" <?php if($sitterLocation == "Fosie") { echo "selected";} ?> >Fosie</option>
                    <option value="Husie" <?php if($sitterLocation == "Husie") { echo "selected";} ?>>Husie</option>
                    <option value="Hyllie" <?php if($sitterLocation == "Hyllie") { echo "selected";} ?>>Hyllie</option>
                    <option value="Kirseberg" <?php if($sitterLocation == "Kirseberg") { echo "selected";} ?>>Kirseberg</option>
                    <option value="Limhamn-Bunkeflo" <?php if($sitterLocation == "Limhamn-Bunkeflo") { echo "selected";} ?>>Limhamn-Bunkeflo</option>
                    <option value="Malmö Centrum" <?php if($sitterLocation == "Malmö Centrum") { echo "selected";} ?>>Malmö Centrum</option>
                    <option value="Oxie" <?php if($sitterLocation == "Oxie") { echo "selected";} ?>>Oxie</option>
                    <option value="Rosengård" <?php if($sitterLocation == "Rosengård") { echo "selected";} ?>>Rosengård</option>
                    <option value="Södra Innerstaden" <?php if($sitterLocation == "Södra Innerstaden") { echo "selected";} ?>>Södra Innerstaden</option>
                    <option value="Västra Innerstaden" <?php if($sitterLocation == "Västra Innerstaden") { echo "selected";} ?>>Västra Innerstaden</option>
                </select>                   
            </div>

            <div id="areaBoxUpdate">
                <div class="areaWrapperUpdate"> 
                    <h2 class="h2-update"> Tillgänglig i områden </h2> 
                    <input type="checkbox" id="Fosie" name="areas[]" value="Fosie" <?php if(in_array("Fosie", $sitterInfo["areas"])) { echo "checked";} ?> >
                    <label for="Fosie"> Fosie </label><br>
                    <input type="checkbox" id="Husie" name="areas[]" value="Husie" <?php if(in_array("Husie", $sitterInfo["areas"])) { echo "checked";} ?> >
                    <label for="Husie"> Husie </label><br>
                    <input type="checkbox" id="Hyllie" name="areas[]" value="Hyllie" <?php if(in_array("Hyllie", $sitterInfo["areas"])) { echo "checked";} ?> >
                    <label for="Hyllie"> Hyllie </label><br>
                    <input type="checkbox" id="Kirseberg" name="areas[]" value="Kirseberg" <?php if(in_array("Kirseberg", $sitterInfo["areas"])) { echo "checked";} ?> >
                    <label for="Kirseberg"> Kirseberg </label><br>
                    <input type="checkbox" id="Limhamn-Bunkeflo" name="areas[]" value="Limhamn-Bunkeflo" <?php if(in_array("Limhamn-Bunkeflo", $sitterInfo["areas"])) { echo "checked";} ?> >
                    <label for="Limhamn-Bunkeflo"> Limhamn-Bunkeflo </label><br>
                    <input type="checkbox" id="MalmoCentrum" name="areas[]" value="Malmö Centrum" <?php if(in_array("Malmö Centrum", $sitterInfo["areas"])) { echo "checked";} ?> >
                    <label for="MalmoCentrum"> Malmö Centrum </label><br>
                    <input type="checkbox" id="Oxie" name="areas[]" value="Oxie" <?php if(in_array("Oxie", $sitterInfo["areas"])) { echo "checked";} ?> >
                    <label for="Oxie"> Oxie </label><br>
                    <input type="checkbox" id="Rosengard" name="areas[]" value="Rosengård" <?php if(in_array("Rosengård", $sitterInfo["areas"])) { echo "checked";} ?> >
                    <label for="Rosengard"> Rosengård </label><br>
                    <input type="checkbox" id="SodraInnerstaden" name="areas[]" value="Södra Innerstaden" <?php if(in_array("Södra Innerstaden", $sitterInfo["areas"])) { echo "checked";} ?>>
                    <label for="SodraInnerstaden"> Södra Innerstaden </label><br>
                    <input type="checkbox" id="VastraInnerstaden" name="areas[]" value="Västra Innerstaden" <?php if(in_array("Västra Innerstaden", $sitterInfo["areas"])) { echo "checked";} ?>>
                    <label for="VastraInnerstaden"> Västra Innerstaden </label><br>
                </div>
            </div>
            
            <div id="dayBoxUpdate"> 
                <h2 class="h2-update"> Dagar jag kan vakta: </h2> 
                <div class="dayWrapperUpdate">  
                    <input class="input-update" type="checkbox" id="Monday" name="days[]" value="Måndag" <?php if(in_array("Måndag", $sitterInfo["days"])) { echo "checked";} ?> >
                    <label for="Monday"> Måndag </label>
                    <input class="input-update" type="checkbox" id="Tuesday" name="days[]" value="Tisdag" <?php if(in_array("Tisdag", $sitterInfo["days"])) { echo "checked";} ?> >
                    <label for="Tuesday"> Tisdag </label>
                    <input class="input-update" type="checkbox" id="Wednesday" name="days[]" value="Onsdag" <?php if(in_array("Onsdag", $sitterInfo["days"])) { echo "checked";} ?> >
                    <label for="Wednesday"> Onsdag </label>
                    <input class="input-update" type="checkbox" id="Thursday" name="days[]" value="Torsdag" <?php if(in_array("Torsdag", $sitterInfo["days"])) { echo "checked";} ?> >
                    <label for="Torsdag"> Torsdag </label>
                    <input class="input-update" type="checkbox" id="Friday" name="days[]" value="Fredag" <?php if(in_array("Fredag", $sitterInfo["days"])) { echo "checked";} ?> >
                    <label for="Friday"> Fredag </label>
                    <input class="input-update" type="checkbox" id="Saturday" name="days[]" value="Lördag" <?php if(in_array("Lördag", $sitterInfo["days"])) { echo "checked";} ?> >
                    <label for="Saturday"> Lördag </label>
                    <input class="input-update" type="checkbox" id="Sunday" name="days[]" value="Söndag" <?php if(in_array("Söndag", $sitterInfo["days"])) { echo "checked";} ?>>
                    <label for="Sunday"> Söndag </label>
                </div>  
            </div>
            <div class="uploadImageUpdate"> 
                <h2 class="h2-update"> Ladda upp en ny profilbild </h2> 
                <input type="file" name="newImageToUpload" id="fileToUpload">
            </div> 
            <div class="update-button-wrapper">
            <button type="submit" class="update-button">Spara</button>
            </div>
        </form>
    </div> 
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $data = loadJSON(__DIR__ . "/../dogsitter/dogsitter.json");

    $imageUrl = $sitterImage;
    $file = $_FILES["newImageToUpload"];

    if (isset($file) && $file["error"] != 4) {
        $file = $_FILES["newImageToUpload"];
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
        "id_sitter" => $loggedInID,
        "first_name" => $_POST["firstName"],
        "last_name" => $_POST["lastName"],
        "email" => $_POST["email"],
        "password" => $_POST["password"],
        "location" => $_POST["Placering"],
        "cost" => $_POST["Timkostnad"],
        "days" => $_POST["days"],
        "areas" => $_POST["areas"],
        "extraInfo" => $_POST["extraInfo"],
        "image" => $imageUrl //spara unika namnet på bilden som sökväg
    ]; 

    for ($i=0; $i < count($data); $i++) { 
        $currData = $data[$i];
        $currUser = $currData["id_sitter"];
        if($loggedInID === $currUser){
            $data[$i] = $updateProfile;
        }
    }

    echo "<div class='feedbackMessage'> <p> Profil Uppdaterad! Se Din Nya Profil  </p> <a href='profile.php'>Här!</a> </p> </div>";

    if (empty($updateProfile["first_name"]) || empty($updateProfile["last_name"]) || empty($updateProfile["email"]) || empty($updateProfile["password"]) || empty($updateProfile["location"]) || empty($updateProfile["cost"]) || empty($updateProfile["days"]) || empty($updateProfile["areas"])|| empty($updateProfile["extraInfo"])) {
        echo "<p class='feedbackMessage'> Alla fält måste vara ifyllda, <br> försök igen </p>";
        exit();
    }

    //Kopierar databasen till en backup-fil innan ändringen görs
    copy("dogsitter.json", "dogsitter_backup.json");

    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/../dogsitter/dogsitter.json", $json);

}
?>
<?php 
    require_once __DIR__ . "/../section/footer.php";
?> 
