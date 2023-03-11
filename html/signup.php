<?php
if(isset($_GET['check'])){
    $weiter = true;
    if (empty(trim($_GET["name"]))) {
        $weiter = false;?><script>document.getElementById("name").placeholder = "Bitte geben Sie ihren Namen ein";</script> <?php 
    }
    if ( ! preg_match("/[a-z]{2,}/i", $_GET["name"]) or preg_match("/[0-9]/i", $_GET["name"])) {
        $weiter = false;?><script>document.getElementById("name").placeholder = "Bitte geben Sie einen gültigen Namen ein";</script> <?php 
    }
    if (empty(trim($_GET["surname"]))) {
        $weiter = false;?><script>document.getElementById("surname").placeholder = "Bitte geben Sie ihren Nachnamen ein";</script> <?php 
    }
    if ( ! preg_match("/[a-z]{2,}/i", $_GET["surname"]) or preg_match("/[0-9]/i", $_GET["surname"])) {
        $weiter = false;?><script>document.getElementById("surname").placeholder = "Bitte geben Sie einen gültigen Nachnamen ein";</script> <?php 
    }
    if ( ! filter_var($_GET["email"])) {
        $weiter = false;?><script>document.getElementById("email").placeholder = "Bitte geben Sie ihre emailadresse ein";</script> <?php 
    }
    if ( ! preg_match("/^[_a-z0-9-.]*@[_a-z0-9-.]*\.[a-z]{2,4}$/i", $_GET["email"])) {
        $weiter = false;?><script>document.getElementById("email").placeholder = "Bitte geben Sie eine Valide emailadresse ein";</script> <?php 
    }
    if (strlen($_GET["password"]) < 8) {
        $weiter = false;?><script>document.getElementById("password").placeholder = "Passwort muss mindestens 8 Zeichen besitzen";</script> <?php 
    }
    if ( ! preg_match("/[a-z]/i", $_GET["password"])) {
        $weiter = false;?><script>document.getElementById("password").placeholder = "Passwort muss Buchstaben und Zahlen beinhalten";</script> <?php 
    }
    if ( ! preg_match("/[0-9]/", $_GET["password"])) {
        $weiter = false;?><script>document.getElementById("password").placeholder = "Passwort muss Buchstaben und Zahlen beinhalten";</script> <?php 
    }
    if ($_GET["password"] !== $_GET["password_confirmation"]) {
        $weiter = false;?><script>document.getElementById("password_confirmation").placeholder = "Passwörter stimmen nicht überein";</script> <?php 
    }
    if (empty($_GET["phone_number"])) {
        $weiter = false;?><script>document.getElementById("phone_number").placeholder = "Bitte eine Telefonnummer angeben";</script> <?php 
    }
    if (is_numeric($_GET["phone_number"]) == false) {
        $weiter = false;?><script>document.getElementById("phone_number").placeholder = "Bitte eine gültige Telefonnummer angeben";</script> <?php 
    }
    if ( ! preg_match("/^(\+[0-9]{2,3}|0+[0-9]{2,5}).+[\d\s\/\(\)-]/", $_GET["phone_number"])) {
        $weiter = false;?><script>document.getElementById("phone_number").placeholder = "Bitte eine gültige Telefonnummer angeben";</script> <?php 
    }
    if (empty($_GET["address"])) {
        $weiter = false;?><script>document.getElementById("address").placeholder = "Bitte geben Sie ihre Adresse ein";</script> <?php 
    }
    if (empty($_GET["postcode"])) {
        $weiter = false;?><script>document.getElementById("postcode").placeholder = "Bitte geben Sie ihren Postleitzahl ein";</script> <?php 
    }
    if ( ! preg_match("/[0-9]{5}/", $_GET["postcode"])) {
        $weiter = false;?><script>document.getElementById("postcode").placeholder = "Bitte geben Sie eine gültige Postleitzahl ein";</script> <?php 
    }

    if($weiter){
        $mysqli = require __DIR__ . "/database.php";
        
        $password_hash = password_hash($_GET["password"], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO user (name, surname, email, phone_number, address, postcode, password_hash)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $mysqli->stmt_init();
        
        if ( ! $stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }
        
        $stmt->bind_param("sssssss",
                        $_GET["name"],
                        $_GET["surname"],
                        $_GET["email"],
                        $_GET["phone_number"],
                        $_GET["address"],
                        $_GET["postcode"],
                        $password_hash);
        
        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        
        }else {
        
            if ($mysqli->errno === 1062) {
                die("E-Mail ist bereits vergeben");
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        } 
          header("Location: /trinkmal/index.php");
    }
        
}    
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta name="author" content="Jonas M. , Simon F.">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trinkmal Account</title>
    <link rel="icon" type="image/x-icon" href="../images/T-logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="../js/main.js"></script>

</head>

<body>
<header>
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="../index.php" class="logo">Trinkmal<span>.</span></a>
    <nav class="navbar">
        <a href="../index.php">Home</a>
        <a href="produktseite.php">Fassbier</a>  
        <a href="kontaktseite.php">Kontakt</a>
    </nav>
    <div class="icons">
        <button class="fas fa-shopping-cart" id="openCart" aria-label="Open shopping cart element"></button>
        <button href="account.html" class="fas fa-user" id="openLogCont" aria-label="Open sing in element"></button>
    </div>
</header>

    <form> 
        <div class="wrapper">
            <div class="title">
                Registrieren
            </div>
            <div class="signup-form">
                <div class="inputfield">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="input">
                </div>
                <div class="inputfield">
                    <label for="surname">Nachname</label>
                    <input type="text" id="surname" name="surname" class="input">
                </div>
                <div class="inputfield">
                    <label for="email">E-Mail</label>
                    <input type="text" id="email" name="email" class="input">
                </div> 
                <div class="inputfield">
                    <label for="password">Passwort</label>
                    <input type="password" id="password" name="password" class="input">
                </div>  
                <div class="inputfield">
                    <label for="password_confirmation">Passwort bestätigen</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input">
                </div>
                <div class="inputfield">
                    <label for="phone_number">Telefonnummer</label>
                    <input type="text" id="phone_number" name="phone_number" class="input">
                </div> 
                <div class="inputfield">
                    <label for="address">Adresse</label>
                    <input type="text" id="address" name="address" class="input"></input>
                </div> 
                <div class="inputfield">
                    <label for="postcode">Postleitzahl</label>
                    <input type="text" id="postcode" name="postcode" class="input">
                </div> 
                
                <div class="inputfield terms">
                    <label class="check">
                    <input type="checkbox" class="check" name="agb"/>
                        <span class="checkmark"></span>
                    </label>
                    <p><a href="agb.html">Nutzungsbedinungen</a> zustimmen</p>
                </div> 

                <div class="inputfield">
                    <input type="submit" name="check" value="registrieren" class="btn">
                </div>

            </div>
        </div>	
    </form>  

    <footer>
    <div class="box-container">
        <div class="box">
            <h3>quick links</h3>
            <a href="../index.php">Home</a>
            <a href="produktseite.php">Produkte</a>
            <a href="kontaktseite.php">Kontakt</a>
        </div>
        <div class="box">
            <h3>extra links</h3>
            <a href="account.html">Mein Account</a>
            <a href="bestellungen.html">Meine Bestellungen</a>
            <!-- <a href="#">Meine Favoriten</a> -->
        </div>
        <div class="box">
            <h3>Standorte</h3>
            <p>Übach-Palenberg</p>
            <p>Geilenkirchen</p>
            <p>Aachen</p>
            <p>Heinsberg</p>
        </div>
        <div class="box">
            <h3>Kontakt Info</h3>
            <a href="tel:01234567890">Telefon: +49 (0)12345 67890</a>
            <a href="mailto:maxmustermann@test.de">E-Mail: example@gmail.com</a>
            <a href="https://www.google.com/maps/place/Am+Wasserturm+22,+52531+%C3%9Cbach-Palenberg/@50.9256507,6.108392,17z/data=!3m1!4b1!4m5!3m4!1s0x47c0a39cad63d097:0x3d4e3e65df584cd9!8m2!3d50.9256507!4d6.1105807" target="_blank">
                Adrese: Am Wasserturm 22 <br>
                52531 Übach-Palenberg, Deutschland</a>
            <img src="../images/payment.png" alt="...">
        </div>
    </div>
    <div> <p class="credit"> © 2022 Trinkmal GmbH <br>
        created by <span> Simon & Jonas </span> | all rights reserved</p>
    </div>
    </footer>

    </body>

    <!-- The Modal -->
<div id="myModal" class="modal">
 
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
 
      <!-- shopping cart content-->
      <div id="items_table">
         <h2>Shopping List</h2>
         <table id="list"></table>
         <label><input type="button" value="Clear" onclick="ClearAll()">
         * Delete all items</label>
     </div>
    </div>
  </div> 

<script>
    // Get the modal
    var modal = document.getElementById("LOGIN");
     
     // Get the button that opens the modal
     var btn = document.getElementById("openLogCont");
     
     // When the user clicks the button, open the modal 
     btn.onclick = function() {
       modal.style.display = "block";
     }
     
     // When the user clicks anywhere outside of the modal, close it
     window.onclick = function(event) {
       if (event.target == modal) {
         modal.style.display = "none";
       }
     }
</script>

<?php
if(isset($_GET['check'])){
    $weiter = true;
    if (empty(trim($_GET["name"]))) {
        $weiter = false;?><script>document.getElementById("name").placeholder = "Bitte geben Sie ihren Namen ein";</script> <?php 
    }
    if ( ! preg_match("/[a-z]{2,}/i", $_GET["name"]) or preg_match("/[0-9]/i", $_GET["name"])) {
        $weiter = false;?><script>document.getElementById("name").placeholder = "Bitte geben Sie einen gültigen Namen ein";</script> <?php 
    }
    if (empty(trim($_GET["surname"]))) {
        $weiter = false;?><script>document.getElementById("surname").placeholder = "Bitte geben Sie ihren Nachnamen ein";</script> <?php 
    }
    if ( ! preg_match("/[a-z]{2,}/i", $_GET["surname"]) or preg_match("/[0-9]/i", $_GET["surname"])) {
        $weiter = false;?><script>document.getElementById("surname").placeholder = "Bitte geben Sie einen gültigen Nachnamen ein";</script> <?php 
    }
    if ( ! filter_var($_GET["email"])) {
        $weiter = false;?><script>document.getElementById("email").placeholder = "Bitte geben Sie ihre emailadresse ein";</script> <?php 
    }
    if ( ! preg_match("/^[_a-z0-9-.]*@[_a-z0-9-.]*\.[a-z]{2,4}$/i", $_GET["email"])) {
        $weiter = false;?><script>document.getElementById("email").placeholder = "Bitte geben Sie eine Valide emailadresse ein";</script> <?php 
    }
    if (strlen($_GET["password"]) < 8) {
        $weiter = false;?><script>document.getElementById("password").placeholder = "Passwort muss mindestens 8 Zeichen besitzen";</script> <?php 
    }
    if ( ! preg_match("/[a-z]/i", $_GET["password"])) {
        $weiter = false;?><script>document.getElementById("password").placeholder = "Passwort muss Buchstaben und Zahlen beinhalten";</script> <?php 
    }
    if ( ! preg_match("/[0-9]/", $_GET["password"])) {
        $weiter = false;?><script>document.getElementById("password").placeholder = "Passwort muss Buchstaben und Zahlen beinhalten";</script> <?php 
    }
    if ($_GET["password"] !== $_GET["password_confirmation"]) {
        $weiter = false;?><script>document.getElementById("password_confirmation").placeholder = "Passwörter stimmen nicht überein";</script> <?php 
    }
    if (empty($_GET["phone_number"])) {
        $weiter = false;?><script>document.getElementById("phone_number").placeholder = "Bitte eine Telefonnummer angeben";</script> <?php 
    }
    if (is_numeric($_GET["phone_number"]) == false) {
        $weiter = false;?><script>document.getElementById("phone_number").placeholder = "Bitte eine gültige Telefonnummer angeben";</script> <?php 
    }
    if ( ! preg_match("/^(\+[0-9]{2,3}|0+[0-9]{2,5}).+[\d\s\/\(\)-]/", $_GET["phone_number"])) {
        $weiter = false;?><script>document.getElementById("phone_number").placeholder = "Bitte eine gültige Telefonnummer angeben";</script> <?php 
    }
    if (empty($_GET["address"])) {
        $weiter = false;?><script>document.getElementById("address").placeholder = "Bitte geben Sie ihre Adresse ein";</script> <?php 
    }
    if (empty($_GET["postcode"])) {
        $weiter = false;?><script>document.getElementById("postcode").placeholder = "Bitte geben Sie ihren Postleitzahl ein";</script> <?php 
    }
    if ( ! preg_match("/[0-9]{5}/", $_GET["postcode"])) {
        $weiter = false;?><script>document.getElementById("postcode").placeholder = "Bitte geben Sie eine gültige Postleitzahl ein";</script> <?php 
    }

    if($weiter){
        $mysqli = require __DIR__ . "/database.php";
        
        $password_hash = password_hash($_GET["password"], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO user (name, surname, email, phone_number, address, postcode, password_hash)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $mysqli->stmt_init();
        
        if ( ! $stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }
        
        $stmt->bind_param("sssssss",
                        $_GET["name"],
                        $_GET["surname"],
                        $_GET["email"],
                        $_GET["phone_number"],
                        $_GET["address"],
                        $_GET["postcode"],
                        $password_hash);
        
        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        
        }else {
        
            if ($mysqli->errno === 1062) {
                die("E-Mail ist bereits vergeben");
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        } 
          header("Location: /trinkmal/index.php");
    }
        
}    
?>

</html>

