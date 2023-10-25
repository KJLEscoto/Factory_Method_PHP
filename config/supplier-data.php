<?php

require $_SERVER["DOCUMENT_ROOT"] . '/php/factory-method/config/database.php';

$sql = "SELECT * FROM supplier";
$result = $conn->query($sql);

$conn->close();

?>