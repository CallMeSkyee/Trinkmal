<?php
session_start();
$is_invalid = false;

if(!isset($_SESSION["logged_in"])){
  $_SESSION["logged_in"] = false;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/html/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_regenerate_id();
            
            if(!isset($_SESSION["user_name"])){
              $_SESSION["user_name"] = $user["name"];
              $_SESSION["surname"] = $user["surname"];
              $_SESSION["phone_number"] = $user["phone_number"];
              $_SESSION["email"] = $user["email"];
              $_SESSION["address"] = $user["address"];
              $_SESSION["postcode"] = $user["postcode"];
              
          }

            $_SESSION["logged_in"] = true;
            
             header("Location: index.php");
             exit;
        }
    }

    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Jonas M. , Simon F.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trinkmal Fassbier</title>
    <link rel="icon" type="image/x-icon" href="images/T-logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/main.js"></script>
</head>

<body onload="loadModal(), loadLogin(), generateCart()">
<header onscroll="hScroll">
  <input type="checkbox" name="" id="toggler">
  <label for="toggler" class="fas fa-bars"></label>

  <a href="index.php" class="logo">Trinkmal<span>.</span></a>

  <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="html/produktseite.php">Fassbier</a>  
      <a href="html/kontaktseite.php">Kontakt</a>
  </nav>

  <div class="icons">
      <button class="fas fa-shopping-cart" id="openCart"></button>
      <button href="html/login.php" class="fas fa-user" id="openLogCont"></button>
  </div>
  <!-- login popup -->
  <?php if($_SESSION["logged_in"] == true){ ?>
  <div class="loginPopup" id="LOGIN">
    <div class="login">
        <div class="login-header" >
            <h2>Wilkommen <?php echo $_SESSION["user_name"]?></h2>
              <form action="/Trinkmal/html/Mein-account.php">
                <input type="submit" value="Mein Konto" class="loggedInButtons" />
              </form>
            <form action="/Trinkmal/html/logout.php">
              <button class="loggedInButtons">logout</button>
            </form>

        </div>
    </div>
</div>
<?php } else{?>

<div class="loginPopup" id="LOGIN"> 
    <div class="login">
        <div class="login-header">
            <h2>ANMELDEN</h2>

            <?php if ($is_invalid): ?>
                <p style="color: red"><em>Anmeldung fehlgeschlagen</em></p>
            <?php endif; ?>

        </div>
    </div>
    <form method="post" >
        <div>
            <label for="email"></label>
            <input type="email" id="email" name="email" placeholder="E-Mail">
        </div>
        <div>
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="passwort">
        </div>
        <button>Anmelden</button>
        <p class="message">Neuer Kunde? <a href="/Trinkmal/html/signup.php">Zur Registrierung</a></p>
    </form>
</div>
<?php }?>

</header>

    <div id="page-container">
        <div id="content-wrap">
        <!-- all other page content -->
        <img src="images/bierzapfhahn1.jpg" alt="..." width="100%">
        </div>
    </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
        <!-- Modal content -->
        
        <div class="modal-content">
          <div class="modal-header">
            <h1>Trinkmal Einkaufswagen <span class="close">&times;</span></h1>
            
          </div>
            <!-- shopping cart content-->

            <div class="column-labels">
    <label class="product-image">Bild</label>
    <label class="product-details">Bier</label>
    <label class="product-price">Preis</label>
    <label class="product-quantity">Menge</label>
    <label class="product-removal">Entfernen</label>
    <label class="product-line-price">Total</label>
  </div>
            <!-------------------- test -------------------->
            <div class="shopping-cart">

 

  <div id="productBlock">
    
     <!-- add item blocks here --> 
    </div>

    
  <div class="totals">
    <div class="totals-item">
      <label>Zwischensumme:</label>
      <div class="totals-value" id="cart-subtotal">0</div>
    </div>
    <div class="totals-item">
      <label>MwSt(19%) Im Preis enthalten:</label>
      <div class="totals-value" id="cart-tax">0</div>
    </div>
    <div class="totals-item">
      <label>Versand:</label>
      <div class="totals-value" id="cart-shipping">0</div>
    </div>
    <div class="totals-item">
      <label>Pfand:</label>
      <div class="totals-value" id="cart-pledge">0</div>
    </div>
    <div class="totals-item totals-item-total">
      <label>Gesamt:</label>
      <div class="totals-value" id="cart-total" name="carttotal">0</div>
    </div>
  </div>
  <form action="/Trinkmal/html/redirect-checkout.php" method="post">
  <input id="product_list" type="hidden" name="product_list" value="">
  <input id="totalCheckout" type="hidden" name="totalCheckout" value=""> <!-- value mit js auf total gesetzt, post zu redirect-sheckout um dort wert als $_SESSION["total"] greifbar zu machen-->
      <!-- falls angemeldet direkt zur zahlung, falls nicht zu formular mit adresseingabe weiterleiten -->
      <input class="checkout" name="submit" type="submit" value="Checkout">
  </form>
  <button onclick="localStorage.clear(), generateCart()" class="remove-all">Alles entfernen</button>

</div>



                    <!--  -->
            <!-------------------- test -------------------->

           
        </div>
    </div> 

  <footer>
    <div class="box-container">
      <div class="box">
          <h3>Quick links</h3>
          <a href="index.php">Home</a>
          <a href="html/produktseite.php">Produkte</a>
          <a href="html/kontaktseite.php">Kontakt</a>
        </div>
    
        <div class="box">
          <h3>Extra links</h3>
          <a href="html/signup.html">Mein Account</a>
          <a href="html/bestellungen.html">Meine Bestellungen</a>
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
          <a href="mailto:example@gmail.com">E-Mail: example@gmail.com</a>
          <a href="https://www.google.com/maps/place/Am+Wasserturm+22,+52531+%C3%9Cbach-Palenberg/@50.9256507,6.108392,17z/data=!3m1!4b1!4m5!3m4!1s0x47c0a39cad63d097:0x3d4e3e65df584cd9!8m2!3d50.9256507!4d6.1105807" target="_blank">
            Adresse: Am Wasserturm 22 <br>
            52531 Übach-Palenberg, Deutschland</a>
          <img src="images/payment.png" alt="...">
        </div>
    </div>

    <div class="credit"> © 2022 Trinkmal GmbH <br>
        created by <span> Simon & Jonas </span> | all rights reserved 
    </div>

  </footer>
</body>

<?php 
if($_SESSION["logged_in"] == true): ?>
<script>
    document.getElementById("openLogCont").style.color="yellow";
</script>
<?php endif; ?>

</html>