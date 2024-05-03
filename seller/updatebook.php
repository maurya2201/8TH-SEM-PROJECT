<?php
include "../config/connection.php";
session_start();
if (!isset($_SESSION['sid']) || $_SESSION['sid'] === null) {
    header("Location:../login.php");
    exit;
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];

$sql = "SELECT * FROM books WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = $_POST['bookname'];
        $price = $_POST['bookprice'];
        $image = $_POST['image'];
        $description = $_POST['bookdescription'];

        $updateSql = "UPDATE books SET name='$name', price='$price', image='$image', description='$description' WHERE id='$id'";

        if ($conn->query($updateSql) === TRUE) {
            $_SESSION['update_book_message'] = "Updated Book Sucessfully!!";
            header("Location: seller.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BookHub||UpdateBook</title>
        <link rel="stylesheet" href="../assets/css/addbook.css">
    </head>
    <body class="container">
        <form class="addbook" method="post">
            <img height="80px" width="100px" src="../assets/images/bookhub-high-resolution-logo-transparent.png">
            <h2>Update book</h2>
            <input class="forminput" type="text" name="bookname" value="<?php echo $row['name'] ?>" required>
            <input class="forminput" type="text" name="bookdescription" value="<?php echo $row['description'] ?>" required>
            <input class="forminput" type="text" name="bookprice" value="<?php echo $row['price'] ?>" required>
            <input class="forminput" type="file" name="image" value="<?php echo $row['image'] ?>" required>
            <input style="display: none;" class="forminput" type="text" name="id" value="<?php echo $id ?>">
            <input id="registerbtn" type="submit" name="submit" value="Update Book">
            <a id="registerbtn" href="seller.php">Back to Home</a>
        </form>
    </body>
</html>