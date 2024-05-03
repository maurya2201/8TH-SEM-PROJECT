<?php
include "../config/connection.php";
session_start();
if (!isset($_SESSION['sid']) || $_SESSION['sid'] === null) {
    header("Location:../login.php");
    exit;
}
$id = $_SESSION['sid'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["bookname"];
    $description = $_POST["bookdescription"];
    $price = $_POST["bookprice"];
    $author = $_POST["bookauthor"];
    $image = $_POST["image"];
    $sellerId = $_POST["sellerid"];
    
    $sql = "INSERT INTO books (name,description, price, author, image, seller_id) VALUES ('$name', '$description' ,'$price', '$author', '$image', '$sellerId');";

    if($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Added Book Sucessfully!";
        header("Location: seller.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub||Add</title>
    <link rel="stylesheet" href="../assets/css/addbook.css">
</head>
</head>
<body class="container">
    <form class="addbook" method="post">
    <img  height="80px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
    <h2>Add book</h2>
    <input class="forminput" type="text" name="bookname" placeholder="Enter Your Bookname" required>
    <input class="forminput" type="text" name="bookdescription" placeholder="Enter Your Book Description" required>
    <input class="forminput" type="text" name="bookprice" placeholder="Enter Your Bookprice" required>
    <input class="forminput" type="text" name="bookauthor" placeholder="Enter Your Bookauthor" required>
    <input class="forminput" type="file" name="image" required>
    <input style="display: none;" class="forminput" type="text" name="sellerid" value="<?php echo $id?>">
    <input id="registerbtn" type="submit" name="submit" value="Add-Book">
    <a id="registerbtn" href="seller.php">Back to Home</a>
    </form>
    
</body>
</html>