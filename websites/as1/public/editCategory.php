<?php
session_start();
require 'header.php';
?>

<?php
if (isset($_SESSION['username'])) {
    if ($_SESSION['userRole'] === "admin") {
        include_once('dbConn.php');
        ?>

        <!-- Edit form -->
        <form action="#" method="POST">
            <label>
                <h1>Edit Category:</h1>
            </label><br><br>
            <label for="name">Change category name : </label>
            <input type="text" name="name" required><br>
            <button type="submit" name="submit">Submit</button>
        </form>
        <?php


        if (isset($_POST['submit'])) {
            // get id from url
            $categoryID = $_GET['categoryID'];
            // First letter capital
            $newCategoryName = ucwords($_POST['name']);
            $editCategoryQuery = $conn->prepare("UPDATE `category` SET `name`='$newCategoryName' WHERE category_id = '$categoryID'");
            $editCategoryQuery->execute();

            echo '<br><p style="color: green">CHANGED SUCCESSFULLY </p> <a href="index.php"><button>Home</button></a>';
        }
    } else {
        echo 'Access Denied. You do not have admin access.';
    }
} else {
    echo 'Please login first <a href="login.php"><button>Login Now!</button></a>';
}
?>