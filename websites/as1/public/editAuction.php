<?php
require 'header.php';
require 'dbCOnn.php';

// getting from the url
$productID = $_GET['CarID'];

$getAuctionQuery = $conn->query("SELECT `title`, `endDate`, `description`, `categoryId`, `price` FROM `auction` WHERE product_id = $productID;");

$getAuctionQuery->execute();
$getAuction = $getAuctionQuery->fetchAll();

foreach ($getAuction as $auction) {
    $title = $auction['title'];
    $endDate = $auction['endDate'];
    $description = $auction['description'];
    $price = $auction['price'];
}

?>



<h2>Edit Auction</h2>


<form action="#" method="POST">
    <label for="title">Prouct name</label>
    <input type="text" name="title" value=<?php
    echo $title;
    ?>><br>
    <label for="description">Description</label>
    <textarea name="description" id="desc" cols="10" rows="6" maxlength="255"><?php
    echo $description;
    ?></textarea>
    <label for="auction_end_date">Date</label>
    <input type="date" name="auction_end_date" value=<?php
    echo $endDate;
    ?>><br>
    <label for="price">Price</label>
    <input type="text" name="price" value=<?php
    echo $price;
    ?>><br>
    <select name="category">
        <?php
        // looping through categories from database
        array_map(function ($categories) {
            $categoryName = $categories['name'];
            echo '<option value="' . $categoryName . '">' . $categoryName . '</option>';
        }, $getCategory);
        ?>
    </select><br>
    <button type="submit" name="submit">Submit</button>
</form>

<!-- After clicking submit button -->

<?php
if (isset($_POST['submit'])) {
    $newTitle = $_POST['title'];
    $newDescription = $_POST['description'];
    $newDate = $_POST['auction_end_date'];
    $newPrice = $_POST['price'];
    $newCategory = $_POST['category'];

    $updateAuctionQuery = $conn->query("UPDATE `auction` SET `title`='$newTitle',`endDate`='$newDate',`description`='$newDescription',`categoryId`='$newCategory',`price`='$newPrice' WHERE product_id='$productID'");
    $updateAuctionQuery->execute();
    echo "Auction Updated";
}
?>