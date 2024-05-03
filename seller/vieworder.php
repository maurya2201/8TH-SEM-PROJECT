<?php
session_start();
if (!isset($_SESSION['sid'])) {
  header("Location:../login.php");
  exit;
}
$id = $_SESSION['sid'];
include "../config/connection.php";
$sql = "SELECT orders.*, users.fullname, users.email,
        users.mobilenumber FROM orders 
        INNER JOIN users ON orders.seller_id = users.user_id 
        WHERE orders.seller_id='$id'";
$result = $conn->query($sql);
$sellerName = "SELECT fullname FROM users WHERE user_id ='$id';";
$resultName = $conn->query($sellerName);
$sellerFullName = mysqli_fetch_assoc($resultName);
$displaySellerName = $sellerFullName["fullname"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller||Book Hub</title>
  <link rel="stylesheet" href="../assets/css/vieworder.css">
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script defer src="../assets/js/vieworder.js"></script>
</head>

<body>
  <header>
    <div class="navbar">
      <div class="logo">
        <a href="seller.php">
          <img height="100px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
        </a>
      </div>
      <nav>
        <ul>
          <li><a href="seller.php">Home</a></li>
          <li><a href="addbook.php">Addbook</a></li>
          <li><a href="vieworder.php">Vieworders</a></li>
          <li><a href="../seller/updateprofile.php">UpdateProfile</a></li>
          <li>
            <a class="logout" href="../logout.php">Logout</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <div class="mainbody">
    <h1><pre>View orders</pre></h1>
    <br>
      <div class="table">
        <table id="vieworder">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phonenumber</th>
              <th>Bookname</th>
              <th>Image</th>
              <th>Quantity</th>
              <th>Totalprice</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
              $fullname = $row['fullname'];
              $email = $row['email'];
              $mobilenumber = $row['mobilenumber'];
              $name = $row['name'];
              $image = $row['image'];
              $quantity = $row['quantity'];
              $totalprice = $row['totalprice'];
              echo "
    <tr>
    <td>$fullname</td>
    <td>$email</td>
    <td>$mobilenumber</td>
    <td>$name</td>
    <td><img height='100px' width='100px' src='../assets/images/$image'></td>
    <td>$quantity</td>
    <td>$$totalprice</td>
    </tr>
    ";}?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>

</html>