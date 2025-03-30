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
$getProductQuery = $conn->query("SELECT * FROM `auctions` WHERE categoryId='$categoryName' ORDER BY endDate DESC LIMIT 10;");
$getProductQuery->execute();
$getProuduct = $getProductQuery->fetchAll();
echo "<h1>Category listing</h1>";

$productCount = $getProductQuery->rowCount();

// display product/ Message
if ($productCount == 0) {
    echo 'No products available for this category <br/>';
    echo '<a href="addAuction.php"><button>Add Now</button></a>';
} else {

    // loop
    array_map(function ($product) {

        // stoping product information
        $productName = $product['title'];
        $productCategory = $product['categoryId'];
        $productDescription = $product['description'];
        $productPrice = $product['price'];
        $productID = $product['product_id'];

        echo '<ul class="productList">
    <li>
        <img src="product.png" alt="product name">.
        <article>
            <h2>' . $productName . '</h2>
            <h3>Category : ' . $productCategory . '</h3>
            <p>' . $productDescription . '</p>

            <p class="price">Current bid: £' . $productPrice . '</p>
            <a href=bidAuction.php?productID=' . $productID . ' class="more auctionLink"> More &gt;&gt;</a>
        </article>
    </li>';
    }, $getProuduct);
}

require 'footer.php';
?>