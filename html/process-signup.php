<?php
if (empty(trim($_POST["name"]))) {
    die("Name ist erforderlich");
}
if ( ! preg_match("/[a-z]{2,}/i", $_POST["name"]) or preg_match("/[0-9]/i", $_POST["name"])) {
    die("Bitte einen validen Namen angeben!");
}
if (empty(trim($_POST["surname"]))) {
    die("Nachname ist erforderlich");
}
if ( ! preg_match("/[a-z]{2,}/i", $_POST["surname"]) or preg_match("/[0-9]/i", $_POST["surname"])) {
    die("Bitte einen validen Nachnamen angeben!");
}
if ( ! filter_var($_POST["email"])) {
    die("Gültige E-Mail-Adresse erforderlich");
}
if ( ! preg_match("/^[_a-z0-9-.]*@[_a-z0-9-.]*\.[a-z]{2,4}$/i", $_POST["email"])) {
    die("Bitte eine valide E-Mail Adresse angeben!");
}
if (strlen($_POST["password"]) < 8) {
    die("Passwort muss mindestens 8 Zeichen lang sein");
}
if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Passwort muss mindestens einen Buchstaben enthalten");
}
if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Passwort muss mindestens eine Zahl enthalten");
}
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwort muss übereinstimmen");
}
if (empty($_POST["phone_number"])) {
    die("Telefonnummer is erforderlich");
}
if (is_numeric($_POST["phone_number"]) == false) {
    die("Telefonnumer bitte als Zahl angeben");
}
if ( ! preg_match("/^(\+[0-9]{2,3}|0+[0-9]{2,5}).+[\d\s\/\(\)-]/", $_POST["phone_number"])) {
    die("Bitte eine valide Telefonnummer angeben!");
}
if (empty($_POST["address"])) {
    die("Adresse ist erforderlich");
}
if (empty($_POST["postcode"])) {
    die("Postleitzahl ist erforderlich");
}
if ( ! preg_match("/[0-9]{5}/", $_POST["postcode"])) {
    die("Bitte eine valide Postleitzahl angeben!");
}
if (isset($_POST["agb"])!= true) {
    die("Bitte aktzeptieren Sie die Nutzungsbedinungen");
}


$mysqli = require __DIR__ . "/database.php";

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "INSERT INTO user (name, surname, email, phone_number, address, postcode, password_hash)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssssss",
                   $_POST["name"],
                   $_POST["surname"],
                   $_POST["email"],
                   $_POST["phone_number"],
                   $_POST["address"],
                   $_POST["postcode"],
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
?>