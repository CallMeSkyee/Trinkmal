<?php
session_start();

if(null === $_SESSION["logged_in"]){
    header("Location: ../index.php");
}

$_SESSION['product_list'] = $_POST['product_list'];
$_SESSION['total'] = $_POST['totalCheckout'];

if (strlen($_SESSION['product_list']) == 0) {
    die("ihr Wahrenkorb ist leer!");
}

if($_SESSION["logged_in"] == true){
    header("Location: createOrder.php");
}else{
    header('Location: precheckout.php');
}
?>