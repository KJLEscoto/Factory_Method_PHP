<?php

require $_SERVER["DOCUMENT_ROOT"] . '/php/factory-method/config/database.php';

$sql = "SELECT company_name, CONCAT(contact_fname, ' ', contact_lname) AS contact_name, phone_number, company_address FROM supplier;";

$result = $conn->query($sql);

$conn->close();

?>