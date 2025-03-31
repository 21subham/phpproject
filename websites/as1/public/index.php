<?php

session_start();
require 'header.php';
require 'dbConn.php';

$getCarQuery = $conn->query('SELECT * FROM `auctions` ORDER BY endDate DESC LIMIT 10;');
$getCarQuery->execute();
$getCar = $getCarQuery->fetchAll();
?>

<main>
	<h1>Latest Car Listings / Search Results / Category listing</h1>
	<?php
	// Generate product list directly using array_map
	array_map(function ($Car) {
		$CarName = htmlspecialchars($Car['Car_Name']);
		$CarCategory = htmlspecialchars($Car['categoryId']);
		$CarDescription = htmlspecialchars($Car['description']);
		$CarPrice = htmlspecialchars($Car['price']);
		$CarID = urlencode($Car['product_id']);

		echo '<ul class="carList">
            <li>
                <img src="car.png" alt="car name">
                <article>
                    <h2>' . $CarName . '</h2>
                    <h3>Category: ' . $CarCategory . '</h3>
                    <p>' . $CarDescription . '</p>
                    <p class="price">Current bid: £' . $CarPrice . '</p>
                    <a href="bidAuction.php?CarID=' . $CarID . '" class="more auctionLink">More &gt;&gt;</a>
                </article>
            </li>
        </ul>';
	}, $getCar);


	require 'footer.php';
	?>
</main>