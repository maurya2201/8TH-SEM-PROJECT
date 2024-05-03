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
  <title>Buyer||Book Hub</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/buyer.css">
  <script defer src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script defer src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
  let bid = "<?php echo $id?>";
  sessionStorage.setItem("id",bid);
  function removeInfo(){
    sessionStorage.clear();
  }
  </script>
  <script defer src="./getbooks.js"></script>
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
    <div class="container">
    <button class="cartbtn btn btn-outline-dark""></button>
    <br>
    <br>
    <div class="row">
    </div>
    </div>
    </div>
  </main>
  <?php
    if (isset($_SESSION['alert_message'])) {
        
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "' . $_SESSION['alert_message'] . '",
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                        color: "#000000"
                    }
                }).showToast();
            });
        </script>';
        unset($_SESSION['alert_message']); 
    }
    ?>
</body>
</html>