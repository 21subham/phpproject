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
        <!-- category add form -->
        <form action="#" method="POST">
            <label>Add Category:</label>
            <input name="category" type="text" required></br>
            <button type="submit" name='addCategory'>Add Category</button>
        </form>

        <?php
        if (isset($_POST['addCategory'])) {
            // for first word capital
            $addCategory = ucwords($_POST['category']);
            $addCategoryQuery = $conn->prepare("INSERT INTO `category`(`name`) VALUES (' $addCategory')");
            $addCategoryQuery->execute();
            echo '<br><p>New Category added successfully </p> <a href="index.php"><button>Home</button></a>';
        }
    } else {
        echo 'Access Denied. You do not have admin access.';
    }
} else {
    echo 'Please login first <a href="login.php"><button>Login Now!</button></a>';
}
require 'footer.php';
?>