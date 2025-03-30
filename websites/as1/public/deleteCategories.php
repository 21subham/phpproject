<?php
session_start();
require 'header.php';
?>

<?php
//check for admin access
if (isset($_SESSION['username'])) {
    if ($_SESSION['userRole'] === "admin") {
        include_once('dbConn.php');
        ?>

        <!-- for user conformation -->
        <form action="#" method="post">
            <h1 style="color: red">CONFIRM DELETION?</h1><br>
            <button type="submit" name="yes" value="Yes">Yes</button>
            <a href="manageCategories.php"><button>No</button></a>
        </form>
        <?php

        // using delete query
        if (isset($_POST['yes'])) {
            // get id from url
            $categoryID = $_GET['categoryID'];
            $deleteCategoryQuery = $conn->prepare("DELETE FROM `category` WHERE category_id='$categoryID'");
            $deleteCategoryQuery->execute();

            echo '<p>Deleted Successfully </p> <a href="index.php"><button>Home</button></a>';
        }
    } else {
        echo 'Access Denied. You do not have admin access.';
    }
} else {
    echo 'Please login first <a href="login.php"><button>Login Now!</button></a>';
}
?>