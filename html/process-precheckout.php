<?php
session_start();

if (empty(trim($_POST["name"]))) {
    die("Name ist erforderlich");
}

if (empty(trim($_POST["surname"]))) {
    die("Nachname ist erforderlich");
}

if ( ! filter_var($_POST["email"])) {
    die("Gültige E-Mail-Adresse erforderlich");
}

if (empty($_POST["phone_number"])) {
    die("Telefonnummer is erforderlich");
}

if (is_numeric($_POST["phone_number"]) == false) {
    die("Telefonnumer bitte als Zahl angeben");
}

if (empty($_POST["address"])) {
    die("Adresse ist erforderlich");
}

if (empty($_POST["postcode"])) {
    die("Postleitzahl ist erforderlich");
}

if (isset($_POST["agb"])!= true) {
    die("Bitte aktzeptieren Sie die Nutzungsbedinungen");
}

$_SESSION["user_name"] = $_POST["name"];
$_SESSION["surname"] = $_POST["surname"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["phone_number"] = $_POST["phone_number"];
$_SESSION["address"] = $_POST["address"];
$_SESSION["postcode"] = $_POST["postcode"];

header("Location: createOrder.php");
?>