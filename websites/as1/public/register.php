<?php 
require 'header.php';
require 'dbConn.php'
?>

<!-- Registration Form -->
 <h1>Registration</h1>

 <form action="#" method="POST">
     <label for="username">Username: </label>
     <input type="text" name="username" required /><br>
     <label for="email">Email: </label>
     <input type="email" name="email" required /><br>
     <label for="password">Password: </label>
     <input type="password" name="password" required><br>
     

     <!-- For Admins -->
     <input type="radio" name="role" value="user"/> <label>user</label>
    <input type="radio" name="role" value="admin"/> <label>admin</label>
    <input type="submit" value="Submit" name="submit" /><br><br>
 </form>

 <!-- Post userdata to DB -->
 <?php
if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $passw = sha1($_POST['password']);
    
    $result = $conn->query("INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES ('$name','$email','$passw','$role')");
    echo 'Thank you for registering <br/> <a href="login.php"><input type="submit" value="Login Now" name="loginBtn" /> </a>';
}

require 'footer.php';
?>
