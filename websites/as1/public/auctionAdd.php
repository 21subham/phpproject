<?php
session_start();
require 'header.php';
if (isset($_SESSION['username'])) {
    // requirements
    include_once('databaseConnection.php');

    if (isset($_POST['submit1'])) {
        $name = $_POST['productName'];
        $description = $_POST['productDesc'];
        $date = $_POST['date'];
        $category = $_POST['categories'];
        $price = $_POST['price'];
        $userID = $_SESSION['userID'];


        $result = $pdo->prepare("INSERT INTO `auctions`(`title`, `endDate`, `description`, `categoryId`,`price`,`user_id`) VALUES ('$name','$date','$description','$category','$price','$userID')");
        $result->execute();
        // header('Location: https://www.youtube.com/');
        // echo "Hello world";
    }
}
?>