<?php
session_start();
require 'header.php';



if (isset($_SESSION['username'])) {
    $userID = $_SESSION['userID'];
    include_once('dbConn.php');
    $getAuctionQuery = $conn->query("SELECT  `product_id`,`Product_Name`, `endDate`, `description`, `categoryId`, `price` FROM `auctions` WHERE user_id = '$userID'");
    $getAuctionQuery->execute();
    $getAuction = $getAuctionQuery->fetchAll();

    echo '<strong>Auctions Posted by : ' . $_SESSION['username'] . '</strong>';
    // foreach ($getAuction as $auctions) {
    //     // getting auction data from database
    //     $auctionName = $auctions['title'];
    //     $productID = $auctions['product_id'];
    //     $strHTML = '<li>' . $auctionName . '</li><a href=editAuction.php?productID=' . $productID . '>edit</a>';
    //     echo $strHTML;
    // }
    array_map(function ($auctions) {
        $auctionName = $auctions['Product_Name'];
        $productID = $auctions['product_id'];
        $Result = '<li>' . $auctionName . '</li><a href=editAuction.php?productID=' . $productID . '>edit</a>';
        echo $Result;
    }, $getAuction);

} else {
    echo 'You are not logged in <a href="login.php"><button>Login Now!</button></a>';
}
