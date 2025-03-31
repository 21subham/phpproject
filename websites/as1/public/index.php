addAuction
bidAuction
editAuction
myAuction



Carpage

<h1>Car Page</h1>
<article class="car">

	<img src="car.png" alt="car name">
	<section class="details">
		<h2>Car model and make</h2>
		<h3>Car category</h3>
		<p>Auction created by <a href="#">User.Name</a></p>
		<p class="price">Current bid: £4000</p>
		<time>Time left: 8 hours 3 minutes</time>
		<form action="#" class="bid">
			<input type="text" name="bid" placeholder="Enter bid amount" />
			<input type="submit" value="Place bid" />
		</form>
	</section>
	<section class="description">
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales ornare purus, non laoreet dolor
			sagittis id. Vestibulum lobortis laoreet nibh, eu luctus purus volutpat sit amet. Proin nec iaculis
			nulla. Vivamus nec tempus quam, sed dapibus massa. Etiam metus nunc, cursus vitae ex nec, scelerisque
			dapibus eros. Donec ac diam a ipsum accumsan aliquet non quis orci. Etiam in sapien non erat dapibus
			rhoncus porta at lorem. Suspendisse est urna, egestas ut purus quis, facilisis porta tellus.
			Pellentesque luctus dolor ut quam luctus, nec porttitor risus dictum. Aliquam sed arcu vehicula, tempor
			velit consectetur, feugiat mauris. Sed non pellentesque quam. Integer in tempus enim.</p>


	</section>

	<section class="reviews">
		<h2>Reviews of User.Name </h2>
		<ul>
			<li><strong>John said </strong> great car seller! Car was as advertised and delivery was quick
				<em>29/01/2024</em>
			</li>
			<li><strong>Dave said </strong> disappointing, Car was slightly damaged and arrived
				slowly.<em>22/12/2023</em></li>
			<li><strong>Susan said </strong> great value but the delivery was slow <em>22/07/2023</em></li>

		</ul>

		<form>
			<label>Add your review</label> <textarea name="reviewtext"></textarea>

			<input type="submit" name="submit" value="Add Review" />
		</form>
	</section>
</article>

<hr />



?????????????????????????????????????????????????????????????

<?php

session_start();
require 'header.php';
require 'dbConn.php';

$getProdQuery = $conn->query('SELECT * FROM `auctions` ORDER BY endDate ASC LIMIT 10;');
$getProdQuery->execute();
$getProuduct = $getProdQuery->fetchAll();
echo "<h1>Latest Listing</h1>";

// loop
foreach ($getProuduct as $product) {

	// storing all product info into a variable
	$productName = $product['Product_Name'];
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
}



require 'footer.php';
?>