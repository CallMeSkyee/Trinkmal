<?php

session_start();
session_destroy();
session_unset();

echo "logout erfolgreich";
header("LOCATION: ../index.php");
?>