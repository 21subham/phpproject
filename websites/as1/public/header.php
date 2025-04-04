<?php
require 'dbConn.php';
?>

<html>

<head>
	<title>Carbuy Auctions</title>
	<link rel="stylesheet" href="carbuy.css" />
	<style>
		.HeaderButton {
			display: inline-block;
			position: relative;

		}

		.HeaderButton-options {
			min-width: 150px;
			max-width: 150px;
			display: none;
			position: absolute;
			overflow: auto;
		}

		.HeaderButton:hover .HeaderButton-options {
			display: block;
			color: black;
			background-color: white;
			width: 10em;
			z-index: 1;
			position: absolute;
			border: 1px solid #ccc;
		}

		.HeaderButton-options {
			display: none;
			flex-direction: column;
			padding: 5px;
		}

		.HeaderButton-options a {
			display: block;
			padding: 5px;
			text-decoration: none;
			color: black;
		}

		.HeaderButton-options a:hover {
			background-color: lightgray;
		}
	</style>
</head>

<body>

	<!-- carbuy + search section -->
	<header>
		<a href="index.php">
			<h1><span class="C">C</span>
				<span class="a">a</span>
				<span class="r">r</span>
				<span class="b">b</span>
				<span class="u">u</span>
				<span class="y">y</span>
			</h1>
		</a>

		<form action="#">
			<input type="text" name="search" placeholder="Search for a car" />
			<input type="submit" name="submit" value="Search" />
		</form>
	</header>


	<!-- Category Section -->
	<nav>
		<ul>
			<?php

			array_map(function ($category) {
				$categoryName = $category['name'];
				$categoryID = $category['category_id'];
				echo '<li>' . '<a class="categoryLink" href="categoryPage.php?categoryID=' . $categoryID . '">' . $categoryName . '</a>' . '</li>';
			}, array_values($getCategory));
			?>
		</ul>
	</nav>


	<div class="headerButton" style="justify-content: center">
		<button>Profile</button>
		<div class="HeaderButton-options">
			<a href="myAuction.php">My auctions</a>
			<a href="addAuction.php">Add Auction</a>
			<a href="register.php">Register</a>
			<a href="login.php">login</a>
			<a href="logout.php">logout</a>
		</div>
	</div>
	<span class="HeaderButton">
		<button>Admin</button>
		<div class="HeaderButton-options">
			<a href="adminCategories.php">Admin Categories</a>
			<a href="addCategory.php">Add Categories</a>
		</div>
		</div>
	</span>

	<img src="banners/1.jpg" alt="Banner" />


</body>

</html>