<?php 
error_reporting(-1);

session_start();
require_once "../section/header.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <title>Profile</title>
</head>

<body>

</body>

<?php
require_once "../section/footer.php";
require_once "../functions.php";

// $data = json_decode(file_get_contents("dogsitter.json"), true);

// //Om email och password skickas med från sign-in.php
// if (isset($_POST["email"], $_POST["password"])) {
//     $email = $_POST["email"];
//     $password = $_POST["password"];
    
//  // Om något av fälten är tomma, skicka tillbaka med error=1
//     if ($email === "" || $password === "") {
//         header("Location: sign-in.php?error=1");
//         exit();
//     } 

//     //Om email och password finns i db.json loggas man in
//    if (validUser($data, $email, $password)) {
       
//         // Representerar att användare är inloggad
//         $_SESSION["loggedInAsDogSitter"] = true;

//         exit();
//     } 

//     if (validEmail($data, $email)) {
//         //email rätt, password fel
//         header("Location: sign-in.php?error=3");
//         exit();
//     } 

//     header("Location: sign-in.php?error=2");
//         exit();
// } 





    <h1>Min Profil</h1>
    <div id="wrapper-dog"></div>
    <div id="wrapper-contact"></div>
    <div id="wrapper-owner"></div>


    <form action="/update.php" method="POST">
        <button type="submit" class="button" id="change-settings">Ändra Uppgifter</button>
    </form>

    <form action="/delete.php" method="POST">
        <button type="submit" class="button" id="delete-account">Radera Konto</button>
    </form>
</body>
<?php
require_once "../section/footer.php";
?>