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
    include("index.php");

    interface IUserFactory {
        public function fetchData();
        public function displayHeader();
        public function displayUser();
    }

    class UserSupplier implements IUserFactory {
        public function fetchData() {
            require('config/supplier-data.php');
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function displayHeader() {
            return ['Company Name', 'Contact Name', 'Phone No.', 'Company Address'];
        }
        public function displayUser() {
            return ['company_name', 'contact_name', 'phone_number', 'company_address'];
        }
    }

    class UserCustomer implements IUserFactory {
        public function fetchData() {
            require('config/customer-data.php');
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function displayHeader() {
            return ['Customer Name', 'Phone No.', 'Customer Address'];
        }

        public function displayUser() {
            return ['customer_name', 'phone_number', 'customer_address'];
        }
    }

    if (isset($_POST['userType'])) {
        $userType = $_POST['userType'];
        $userFactory = null;

        if ($userType === 'Supplier') {
            $userFactory = new UserSupplier();
            $title = 'List of Suppliers';
        } elseif ($userType === 'Customer') {
            $userFactory = new UserCustomer();
            $title = 'List of Customers';
        } elseif ($userType === 'Clear') {
            header("Location: index.php");
            exit();
        }

        $data = $userFactory->fetchData();
        $tableHeader = $userFactory->displayHeader();
        $tableData = $userFactory->displayUser();
        
        echo '<header>';
        //echo '<h4><a href="index.php">< Back</a></h4>';
        echo '<h1>' . $title . '</h1>';
        echo '</header>';
        echo '<hr>';

        echo '<table>';
        echo '<thead>';
        echo '<th>#</th>';
        foreach ($tableHeader as $header) {
            echo '<th>' . $header . '</th>';
        }
        echo '</thead>';
        echo '<tbody>';
        
        $id = 1;
        foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . $id . '</td>';
            foreach ($tableData as $key) {
                echo '<td>' . $row[$key] . '</td>';
            }
            echo '</tr>';
            $id++;
        }

        echo '</tbody>';
        echo '</table>';
    }
  ?>

</body>

</html>