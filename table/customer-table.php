<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table | Customer</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <h4>
      <a href="../factory-method/index.php">
        < Back </a>
    </h4>
    <h1>List of Customers</h1>
  </header>
  <hr>
  <table>
    <thead>
      <th>#</th>
      <th>Customer Name</th>
      <th>Phone No.</th>
      <th>Customer Address</th>
    </thead>
    <tbody>
      <?php
        require('config/customer-data.php');
        $id = 1;
        while($row = $result->fetch_assoc()) {
        ?>
      <tr>
        <td><?php echo $id;?></td>
        <td>
          <?php echo $row['customer_fname'];?>
          <?php echo $row['customer_lname'];?>
        </td>
        <td><?php echo $row['phone_number'];?></td>
        <td><?php echo $row['customer_address'];?></td>
      </tr>
      <?php 
    $id++;
    } ?>
    </tbody>
  </table>
</body>

</html>