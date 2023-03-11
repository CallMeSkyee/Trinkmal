<?php
    session_start();

?>

<!DOCTYPE html>
<head>
    <meta name="author" content="Jonas M. , Simon F.">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ihr Kontakt</title>
    <link rel="icon" type="image/x-icon" href="../images/T-logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="../js/main.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

</head>
<body>
    <div class="wrapper">
        <form action="process-precheckout.php" method="post">
            <div class="title">
                Ihre Kontaktdaten
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
                <!-- zu checkout.php posten, erst dort bei zahlung in datenbank posten, product_list möglicherweise in session speichern und abrufen-->
                <div class="inputfield">
                    <input type="submit" value="Weiter zum Zahlen" class="btn">
                </div>
                  
            </div>
        </form>
        <button onclick="window.location.href='produktseite.php'" id="back">Abbrechen</button>
    </div>	
   
</body>