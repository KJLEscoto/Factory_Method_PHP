<?php

require $_SERVER["DOCUMENT_ROOT"] . '/php/factory-method/config/database.php';

$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

$conn->close();

?>