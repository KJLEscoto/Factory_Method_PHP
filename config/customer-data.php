<?php

require $_SERVER["DOCUMENT_ROOT"] . '/php/factory-method/config/database.php';

$sql = "SELECT CONCAT(customer_fname, ' ', customer_lname) AS customer_name, phone_number, customer_address FROM customer;";
$result = $conn->query($sql);

$conn->close();

?>