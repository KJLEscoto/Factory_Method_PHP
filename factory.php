<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Factory Table</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php
  
// Define an interface for the factory
interface IUserFactory {
    public function displayUser();
}

// Implement concrete factories
class UserSupplier implements IUserFactory {
    public function displayUser() {
        return new Supplier();
    }
}

class UserCustomer implements IUserFactory {
    public function displayUser() {
        return new Customer();
    }
}

// Define product classes
class Supplier {
    private $data;

    public function setData($data) {
        $this->data = $data;
    }

    public function fetchDataFromSupplier() {
        require('config/supplier-data.php');
        $this->data = $result->fetch_all(MYSQLI_ASSOC);
    }

    public function display() {
        if ($this->data === null) {
            $this->fetchDataFromSupplier();
        }

        $id = 1;
        ?>

  <header>
    <h4>
      <a href="index.php">
        < Back </a>
    </h4>
    <h1>List of Suppliers</h1>
  </header>

  <hr>

  <table>
    <thead>
      <th>#</th>
      <th>Company Name</th>
      <th>Contact Name</th>
      <th>Phone No.</th>
      <th>Company Address</th>
    </thead>
    <tbody>

      <?php
        foreach ($this->data as $row) {
            $companyName = $row['company_name'];
            $contactName = $row['contact_fname'] . ' ' . $row['contact_lname'];
            $phoneNumber = $row['phone_number'];
            $companyAddress = $row['company_address'];
    ?>

      <tr>
        <td> <?php echo $id ?> </td>
        <td> <?php echo $companyName ?> </td>
        <td> <?php echo $contactName ?> </td>
        <td> <?php echo $phoneNumber ?> </td>
        <td> <?php echo $companyAddress ?> </td>
      </tr>

      <?php $id++; ?>
      <?php } ?>

    </tbody>
  </table>
  <?php 
    }
}

class Customer {
    private $data;

    public function setData($data) {
        $this->data = $data;
    }

    public function fetchDataFromCustomer() {
        require('config/customer-data.php');
        $this->data = $result->fetch_all(MYSQLI_ASSOC);
    }

    public function display() {
        if ($this->data === null) {
            $this->fetchDataFromCustomer();
        }

        $id = 1;
        ?>

  <header>
    <h4>
      <a href="index.php">
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
        foreach ($this->data as $row) {
            $customerName = $row['customer_fname'] . ' ' . $row['customer_lname'];
            $phoneNumber = $row['phone_number'];
            $customerAddress = $row['customer_address'];
    ?>

      <tr>
        <td> <?php echo $id ?> </td>
        <td> <?php echo $customerName ?> </td>
        <td> <?php echo $phoneNumber ?> </td>
        <td> <?php echo $customerAddress ?> </td>
      </tr>

      <?php $id++; ?>
      <?php } ?>

    </tbody>
  </table>
  <?php 
    }
}

// class Customer {
//     public function display() {
//         include "table/customer-table.php";
//     }
// }

// to display
if (isset($_POST['userType'])) {
    $userType = $_POST['userType'];

    if ($userType === 'Supplier') {
        $userFactory = new UserSupplier();
    } else if ($userType === 'Customer') {
        $userFactory = new UserCustomer();
    }

    $display_table = $userFactory->displayUser();
    $display_table->display();
}

?>
</body>

</html>