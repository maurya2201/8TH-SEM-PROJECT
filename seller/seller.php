<?php
session_start();
if (!isset($_SESSION['sid'])) {
    header("Location:../login.php");
    exit;
}
$id = $_SESSION['sid'];
include "../config/connection.php";
$sql = "SELECT * FROM books WHERE seller_id='$id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller||Book Hub</title>
  <link rel="stylesheet" href="../assets/css/seller.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script defer src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <script defer type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script defer src="../assets/js/sellertable.js"></script>
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
          <li><a href="../seller/addbook.php">AddBook</a></li>
          <li><a href="vieworder.php">Vieworders</a></li>
          <li><a href="updateprofile.php">UpdateProfile</a></li>
          <li>
        <a class="logout" href="../logout.php">Logout</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <div class="mainbody">
      <div class="table">
      <table id="books">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Author</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $author = $row['author'];
            $image = $row['image'];
            echo "
    <tr><td>$name</td>
    <td>$description</td>
    <td>$$price</td>
    <td>$author</td>
    <td><img height='100px' width='100px' src='../assets/images/$image'></td>
    <td>
    <div style='display:flex;'>
    <button class='update'><a href='updatebook.php?id=$id'>Update</a></button> 
    <button class='delete'><a href='deletebook.php?id=$id'>Delete</a></button>
    </div>
    </td>
    </tr>
    ";
    }?>
    </tbody>
      </table>
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
    if (isset($_SESSION['message'])) {
      echo '<script>
          document.addEventListener("DOMContentLoaded", function() {
              Toastify({
                  text: "' . $_SESSION['message'] . '",
                  className: "info",
                  style: {
                      background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                      color: "#000000"
                  }
              }).showToast();
          });
      </script>';
      unset($_SESSION['message']); 
    }
    if (isset($_SESSION['update_book_message'])) {
      echo '<script>
          document.addEventListener("DOMContentLoaded", function() {
              Toastify({
                  text: "' . $_SESSION['update_book_message'] . '",
                  className: "info",
                  style: {
                      background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                      color: "#000000"
                  }
              }).showToast();
          });
      </script>';
      unset($_SESSION['update_book_message']); 
    }
    if (isset($_SESSION['delete_book_message'])) {
      echo '<script>
          document.addEventListener("DOMContentLoaded", function() {
              Toastify({
                  text: "' . $_SESSION['delete_book_message'] . '",
                  className: "info",
                  style: {
                      background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                      color: "#000000"
                  }
              }).showToast();
          });
      </script>';
      unset($_SESSION['delete_book_message']); 
    }
  ?>
</body>
</html>