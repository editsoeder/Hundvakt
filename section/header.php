<?php
require_once "../functions.php";
error_reporting(-1);
        //Om personen är inloggad så kommer nav visa alla länkar annars bara de tre väsentliga
?>


<body>
    <main>
        <header>
            <div id="header-image"></div>
        </header>

<?php
        if (isset($_SESSION["loggedInAsDogOwner"])) {
            echo '<nav>
            <a href="/dogowner/profile.php" >Hundvakter</a>
            <a href/dogownerread.php" >Profil</a>
            <a href="/dogowner/sign-out.php" >Logga Ut</a>
</nav>';
        if(isset($_SESSION["loggedInAsDogSitter"])){
            echo '<nav>
            <a href="/dogsitter/profile.php" >Hundar</a>
            <a href="/dogsitter/read.php" >Profil</a>
            <a href="/dogsitter/sign-out.php" >Logga Ut</a>
</nav>';  
        }
        } else {
            echo '<nav></nav>';
        }
?>
</main>
</body>