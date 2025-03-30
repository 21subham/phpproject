<?php
session_start();
require 'header.php';
include_once('dbConn.php');
?>

<!-- Logout Form -->
<form action="#" method="POST">
    <button type="submit" name="logout" value="Logout">Logout</button>
</form>

<?php
//remove userdata from session

if (isset($_POST['logout'])) {
    
    unset($_SESSION['username']);
    unset($_SESSION['userRole']);
    unset($_SESSION['userID']);
   
    $_SESSION['loggedin'] = false;
    echo 'Logout Successful';
}


require 'footer.php';
?>