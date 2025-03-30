<?php
session_start();
require 'header.php';
include_once('dbConn.php');

//remove userdata from session
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
   
    echo "Already Logged out";
    echo ' <br> <a href="login.php"><button>Login</button></a>';
    
    
    exit();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    echo 'You are not logged in';
}
?>



<!-- Logout Form -->
<form action="#" method="POST">
    <p>Ready to Logout ?</p>
    <button type="submit" name="logout" value="Logout">Logout</button>
</form>

 <?php
require 'footer.php';
?> 