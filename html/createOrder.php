<?php
session_start();
$mysqli = require __DIR__ . "/database.php";


$description = $_SESSION['product_list'];
$total = $_SESSION['total'];
$status = "payment pending";

$sql = "INSERT INTO orders (surname, name, phone_number, address, postcode, product_list, status)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();

        if ( ! $stmt->prepare($sql)) {
          die("SQL error: " . $mysqli->error);
      }

      $stmt->bind_param("sssssss",
                  $_SESSION["surname"],
                  $_SESSION["user_name"],
                  $_SESSION["phone_number"],
                  $_SESSION["address"],
                  $_SESSION["postcode"],
                  $description,
                  $status,
                );

                  if ($stmt->execute()) {
                    header("Location: checkout.php");
                    exit;
                }

?>