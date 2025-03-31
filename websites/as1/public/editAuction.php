<?php
require 'header.php';
require 'dbCOnn.php';

// getting from the url
$productID = $_GET['CarID'];

$getAuctionQuery = $conn->query("SELECT `Car_Name`, `endDate`, `description`, `categoryId`, `price` FROM `auctions` WHERE product_id = $productID;");

$getAuctionQuery->execute();
$getAuction = $getAuctionQuery->fetchAll();

foreach ($getAuction as $auction) {
    $title = $auction['Car_Name'];
    $endDate = $auction['endDate'];
    $description = $auction['description'];
    $price = $auction['price'];
}

?>



<h2>Edit Auction</h2>


<form action="#" method="POST">
    <label for="carName">Prouct name</label>
    <input type="text" name="carName" value=<?php
    echo $title;
    ?>><br>
    <label for="carDesc">Description</label>
    <textarea name="carDesc" id="desc" cols="10" rows="6" maxlength="255"><?php
    echo $description;
    ?></textarea>
    <label for="date">Date</label>
    <input type="date" name="date" value=<?php
    echo $endDate;
    ?>><br>
    <label for="price">Price</label>
    <input type="text" name="price" value=<?php
    echo $price;
    ?>><br>
    <select name="categories">
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
    $newTitle = $_POST['carName'];
    $newDescription = $_POST['carDesc'];
    $newDate = $_POST['date'];
    $newPrice = $_POST['price'];
    $newCategory = $_POST['categories'];

    $updateAuctionQuery = $conn->query("UPDATE `auctions` SET `Car_Name`='$newTitle',`endDate`='$newDate',`description`='$newDescription',`categoryId`='$newCategory',`price`='$newPrice' WHERE product_id='$productID'");
    $updateAuctionQuery->execute();
    echo "Auction Updated";
}
?>