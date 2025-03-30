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
			display: none;
			position: absolute;
			overflow: auto;
			
			
			
			
		}

		.HeaderButton:hover .HeaderButton-options {
			display: block;
			
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
			<span class="y">y</span></h1></a>

			<form action="#">
				<input type="text" name="search" placeholder="Search for a car" />
				<input type="submit" name="submit" value="Search" />
			</form>
		</header>


		<!-- Category Section -->
		<nav>
			<ul>
				<li><a class="categoryLink" href="#">Estate</a></li>
				<li><a class="categoryLink" href="#">Electric</a></li>
				<li><a class="categoryLink" href="#">Coupe</a></li>
				<li><a class="categoryLink" href="#">Saloon</a></li>
				<li><a class="categoryLink" href="#">4x4</a></li>
				<li><a class="categoryLink" href="#">Sports</a></li>
				<li><a class="categoryLink" href="#">Hybrid</a></li>
				<li><a class="categoryLink" href="#">More</a></li>
			</ul>
		</nav>


		<div class="headerButton" style="justify-content: center">
		<button>Profile</button>
		<div class="HeaderButton-options">
			<a href="myAuction.php">View</a>
			<a href="addAuction.php">Add</a>
			<a href="register.php">Register</a>
			<a href="login.php">login</a>
			<a href="logout.php">logout</a>
		</div>
	</div>
	<span class="HeaderButton">
		<button>Admin</button>
		<div class="HeaderButton-options">
			<a href="adminCategories.php">Show-Categories</a>
			<!-- <a href="addCategories.php">Delete-Categories</a> -->
			<a href="addCategories.php">Add-Categories</a>
			<a href="logout.php">logout</a>
		</div>
		</div>
	</span>
		<img src="banners/1.jpg" alt="Banner" />


	</body>
</html>
