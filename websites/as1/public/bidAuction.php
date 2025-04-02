<?php
session_start();
require 'header.php';

if (isset($_SESSION['username'])) {
    include_once('dbConn.php');
    $productID = $_GET['CarID'];

    // to get car info
    $getBidQuery = $conn->query("SELECT * FROM `auctions` WHERE product_id = $productID");
    $getBidQuery->execute();
    $bidInfoResult = $getBidQuery->fetchAll();

    // getting the car info
    foreach ($bidInfoResult as $results) {
        $name = $results['Car_Name'];
        $category = $results['categoryId'];
        $price = $results['price'];
        $description = $results['description'];
        $userID = $results['user_id'];
    }

    //seller info 
    $getUsername = $conn->query("SELECT * FROM `users` WHERE id='$userID'");
    $getUsername->execute();
    $usernameResult = $getUsername->fetchAll();

    foreach ($usernameResult as $values) {
        $username = $values['name'];
        $sellerID = $values['id'];
    }


    //handle bid submission
    if (isset($_POST['submit_bid'])) {
        $bidPrice = $_POST['bid'];

        // Only execute if new bid is higher and not empty
        if (!empty($bidPrice)) {
            if ($bidPrice > $price) {
                $updatePriceQuery = $conn->query("UPDATE `auctions` SET `price` = '$bidPrice' WHERE product_id = '$productID'");
                $updatePriceQuery->execute();
            } else {
                $bidError = 'Your bid must be higher than the current bid.';
            }
        } else {
            $bidError = 'Please enter a bid amount.';
        }
    }
    // review submission handler
    if (isset($_POST['submit_review']) && !empty(trim($_POST['reviewtext']))) {
        $reviewsText = trim($_POST['reviewtext']);
        $date = date("Y-m-d");
        $reviewBy = $_SESSION['userID'];

        // Check if review already exists
        $checkReview = $conn->prepare("SELECT 1 FROM `review` WHERE `review` = ? AND `postedBy` = ? AND `forUser` = ?");
        $checkReview->execute([$reviewsText, $reviewBy, $sellerID]);

        if (!$checkReview->fetch()) {
            $conn->prepare("INSERT INTO `review`(`review`, `postedBy`, `date`, `forUser`) VALUES (?, ?, ?, ?)")
                ->execute([$reviewsText, $reviewBy, $date, $sellerID]);
        }
    }
    ?>

    <h1>Car Page</h1>
    <article class="car">

        <img src="car.png" alt="car name">
        <section class="details">
            <h2><?php echo $name; ?></h2>
            <h3>Category : <?php echo $category; ?></h3>
            <p>Auction created by <a href="#"><?php echo $username; ?></a></p>
            <p class="price">Current bid: £ <?php echo $price; ?></p>
            <time>Time left: 8 hours 3 minutes</time>

            <!-- Bid form with error handling -->
            <form action="#" method="POST" class="bid">
                <input type="text" name="bid" placeholder="Enter bid amount" />
                <input type="submit" name="submit_bid" value="Place bid" />

            </form>
        </section>
        <section class="description">
            <p><?php echo $description; ?></p>
        </section>

        <!-- print reviews -->
        <?php
        $getReviewsQuery = $conn->query("SELECT u.name, r.review, r.date FROM users u , review r WHERE forUser=$sellerID AND id = postedBy");
        $getReviewsQuery->execute();
        $reviewsResults = $getReviewsQuery->fetchAll();
        ?>

        <section class="reviews">
            <h2>Reviews of <?php echo $username; ?> </h2>
            <ul>
                <?php
                foreach ($reviewsResults as $result2) {
                    $review = $result2['review'];
                    $postedBy = $result2['name'];
                    $datePosted = $result2['date'];
                    echo '<li><strong>' . $postedBy . ' said </strong>' . $review . ' <em>' . $datePosted . '</em></li>';
                }
                ?>
            </ul>

            <!-- Review form with error handling -->
            <form action="#" method="POST">
                <label for="reviewtext">Add your review</label>
                <textarea name="reviewtext"></textarea>
                <input type="submit" name="submit_review" value="Add Review" />

            </form>
        </section>
    </article>

    <?php
} else {
    echo 'You are not logged in <a href="login.php"><button>Login Now!</button></a>';
}
?>