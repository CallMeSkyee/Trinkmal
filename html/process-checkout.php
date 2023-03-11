<?php 

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO orders (name, surname, email, phone_number, address, postcode, ordered_products)
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
                $_POST["product_list"]);

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