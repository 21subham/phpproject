<?php
include_once('dbConn.php');
require 'header.php';

//fetch category name from id
$getCategoryFromLink = $_GET['categoryID'];
$getCategoryName = $conn->query("SELECT name FROM category WHERE category_id='$getCategoryFromLink'");
$getCategoryName->execute();
$categoryName = $getCategoryName->fetchAll();

// get the category names
foreach ($categoryName as $category) {
    $categoryName = $category['name'];
}

// same code as index page
$getCarQuery = $conn->query("SELECT * FROM `auction` WHERE categoryId='$categoryName' ORDER BY endDate DESC LIMIT 10;");
$getCarQuery->execute();
$getCar = $getCarQuery->fetchAll();
echo "<h1>Category listing</h1>";

$CarCount = $getCarQuery->rowCount();

// display product/ Message
if ($CarCount == 0) {
    echo 'No products available for this category <br/>';
    echo '<a href="addAuction.php"><button>Add Now</button></a>';
} else {

    // loop
    array_map(function ($Car) {

        // stoping product information
        $CarName = $Car['title'];
        $CarCategory = $Car['categoryId'];
        $CarDescription = $Car['description'];
        $CarPrice = $Car['price'];
        $CarID = $Car['product_id'];

        echo '
        <ul class="productList">
    <li>
        <img src="car.png" alt="car name">.
        <article>
            <h2>' . $CarName . '</h2>
            <h3>Category : ' . $CarCategory . '</h3>
            <p>' . $CarDescription . '</p>

            <p class="price">Current bid: £' . $CarPrice . '</p>
            <a href=bidAuction.php?CarID=' . $CarID . ' class="more auctionLink"> More &gt;&gt;</a>
        </article>
    </li>';
    }, $getCar);
}

require 'footer.php';
?>