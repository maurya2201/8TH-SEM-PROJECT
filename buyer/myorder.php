<?php
session_start();
if (!isset($_SESSION['bid'])) {
    header("Location:../login.php");
    exit;
}
$id = $_SESSION['bid'];
include "../config/connection.php";
$sql = "SELECT orders.quantity, orders.id, orders.name, orders.image, orders.totalprice, users.fullname
        FROM orders 
        INNER JOIN users ON orders.seller_id = users.user_id 
        WHERE orders.buyer_id='$id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buyer||Book Hub</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/myorder.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script defer src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer charset="utf8"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" defer></script>
<script>
  let bid = "<?php echo $id?>";
  sessionStorage.setItem("id",bid);
  function removeInfo(){
    sessionStorage.clear();
  }
</script>
<script defer src="../assets/js/myorder.js"></script>
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
    <h1><pre>My orders</pre></h1>
    <table id="myorder">
        <thead>
          <tr> 
            <th>Bookname</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Totalprice</th>
            <th>SellerName</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $fullname = $row['fullname'];
            $name = $row['name'];
            $image = $row['image'];
            $quantity = $row['quantity'];  
            $totalprice = $row['totalprice'];    
            echo "
    <tr>
    <td>$name</td>
    <td><img height='100px' width='100px' src='../assets/images/$image'></td>
    <td>$quantity</td> 
    <td>$$totalprice</td>
    <td>$fullname</td>
    <td><button  class='btn btn-outline-dark'type='button' onclick=\"location.href='deleteorder.php?id=" . $row["id"] . "'\">CancelOrder</button></td>
    </tr>
    ";
    }?>
    </tbody>
      </table>
    </div>
  </main>
</body>
</html>