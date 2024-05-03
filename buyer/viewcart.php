<?php
session_start();
if (!isset($_SESSION['bid']) || $_SESSION['bid'] === null) {
  header("Location:../login.php");
  exit;
}
$id = $_SESSION['bid'];
include "../config/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buyer||View Cart</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/cart.css">
  <script defer src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script defer src="../assets/js/cart.js"></script>
  <script defer src="./cart.js"></script>
</head>

<body>
  <header>
    <div class="navbarbuyer">
      <div class="logo">
        <a href="buyer.php">
          <center>
          <img height="100px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
          </center>
        </a>
      </div>
      <nav>
        <ul>
          <li><a href="buyer.php">Home</a></li>
          <li><a href="myorder.php">MyOrders</a></li>
          <li><a href="updateprofile.php">UpdateProfile</a></li>
          <li><a onclick="removeInfo()" class="logout" href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <div class="mainbody">
      <h1><pre></pre></h1>
      <table id="cart">
      <thead>
      <tr>
      <th>Name</th>
      <th>Image</th>
      <th>Price</th>
      <th>Quantity</th>  
      <th>Remove</th>
      </tr>
      </thead>
      <tbody>
      </tbody>
      </table>
      <br>
      <br>
      <td><button class="btn btn-outline-success" onclick="placeOrder()">Place order</button></td>
    </div>
  </main>
</body>
</html>