<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}
include "../config/connection.php";
$sql = "SELECT users.*, user_types.type_name 
        FROM users 
        INNER JOIN user_types ON users.user_type_id = user_types.user_type_id 
      ";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin||BookHub</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script defer src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script defer src="../assets/js/admintable.js"></script>
</head>

<body>
  <header>
    <div class="navbar">
      <div class="logo">
        <a href="admin.php">
          <img height="100px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
        </a>
      </div>
      <nav>
        <ul>
          <li>Welcome Admin</li>
          <li><a href="admin.php">Home</a></li>
          <li><a href="../admin/adduser.php">Adduser</a></li>
          <li><a href="books.php">Books</a></li>
          <li><a class="logout" href="../logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <div class="mainbody">
    <div class="userTable">
    <div id="addusers">
    </div>
      <table id="admin">
        <thead>
        <tr>
          <th>Fullname</th>
          <th>Email</th>
          <th>Mobilenumber</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row=mysqli_fetch_assoc($result)){
          $id = $row["user_id"];
          $name = $row["fullname"];
          $email = $row["email"];
          $number = $row["mobilenumber"];
          $user_name = $row['type_name'];
          $otp = $row['otp'];
          $state = $row['user_state'];
          $userState;
          if($state==="valid"){
            $userState="Deactivate";
          }else{
            $userState="Activate";
          }
          echo "<tr>
        <td>$name</td>
        <td>$email</td>
        <td>$number</td>
        <td>$user_name</td>
        <td style='display:flex;padding:20px;'>
        <div><button class='state' type='button' onclick=\"location.href='updatestate.php?id=" . $row["user_id"] . "'\">$userState</button></div>    
        <div><button class='update' type='button' onclick=\"location.href='updateuser.php?id=" . $row["user_id"] . "'\">Update</button></div>    
        <div><button class='delete' type='button' onclick=\"location.href='deleteuser.php?id=" . $row["user_id"] . "'\">Delete</button></div>
        </td>
        </tr>";
        }
        ?>
        </tbody>
      </table>
      </div>
    </div>
  </main>
  <?php
  if (isset($_SESSION['user_state'])){
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Toastify({
                text: "' . $_SESSION['user_state'] . '",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                    color: "#000000"
                }
            }).showToast();
        });
    </script>';
    unset($_SESSION['user_state']); 
}
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
  if (isset($_SESSION['add_user_message'])) {
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Toastify({
                text: "' . $_SESSION['add_user_message'] . '",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #eab676e6, #eab676e6)",
                    color: "#000000"
                }
            }).showToast();
        });
    </script>';
    unset($_SESSION['add_user_message']); 
  }

  ?>
</body>
</html>