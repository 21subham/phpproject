<?php
session_start();
require 'header.php';

if (isset($_SESSION['username'])) {
    include_once('dbConn.php');
    $productID = $_GET['CarID'];

    // get car info
    $bidInfo = $conn->prepare("SELECT * FROM `auction` WHERE product_id = ?");
    $bidInfo->execute([$productID]);
    $car = $bidInfo->fetch();

    // get seller info
    $userQuery = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $userQuery->execute([$car['user_id']]);
    $seller = $userQuery->fetch();

    // Handle submit
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (!empty($_POST['bid']) && $_POST['bid'] > $car['price']) {
            $conn->prepare("UPDATE `auction` SET `price` = ? WHERE product_id = ?")->execute([$_POST['bid'], $productID]);
            $car['price'] = $_POST['bid'];
        }

        if (!empty(trim($_POST['reviewText']))) {
            $reviewBy = $_SESSION['userID'];
            $reviewText = trim($_POST['reviewText']);
            $date = date("Y-m-d");

            // prevent multiple queries (review duplication)
            $checkReview = $conn->prepare("SELECT 1 FROM `review` WHERE `review` = ? AND `postedBy` = ? AND `forUser` = ?");
            $checkReview->execute([$reviewText, $reviewBy, $seller['id']]);

            if (!$checkReview->fetch()) {
                $conn->prepare("INSERT INTO `review`(`review`, `postedBy`, `date`, `forUser`) VALUES (?, ?, ?, ?)")->execute([$reviewText, $reviewBy, $date, $seller['id']]);
            }
        }
    }

    // get reviews
    $reviews = $conn->prepare("SELECT u.name, r.review, r.date FROM users u, review r WHERE r.forUser = ? AND u.id = r.postedBy");
    $reviews->execute([$seller['id']]);
    ?>

    <h1>Car Page</h1>
    <article class="car">
        <img src="car.png" alt="Car Image">
        <section class="details">
            <h2><?= htmlspecialchars($car['Car_Name']); ?></h2>
            <h3>Category: <?= htmlspecialchars($car['categoryId']); ?></h3>
            <p>Auction created by <a href="#"><?= htmlspecialchars($seller['name']); ?></a></p>
            <p class="price">Current bid: £<?= htmlspecialchars($car['price']); ?></p>
            <time>Time left: 8 hours 3 minutes</time>

            <form method="POST">
                <input type="text" name="bid" placeholder="Enter bid amount" />
                <input type="submit" name="submit" value="Place bid" />
            </form>
        </section>

        <section class="description">
            <p><?= htmlspecialchars($car['description']); ?></p>
        </section>

        <section class="reviews">
            <h2>Reviews of <?= htmlspecialchars($seller['name']); ?></h2>
            <ul>
                <?php foreach ($reviews as $r): ?>
                    <li><strong><?= htmlspecialchars($r['name']); ?> said</strong> <?= htmlspecialchars($r['review']); ?>
                        <em><?= htmlspecialchars($r['date']); ?></em>
                    </li>
                <?php endforeach; ?>
            </ul>

            <form method="POST">
                <label for="reviewText">Add your review</label>
                <textarea name="reviewText"></textarea>
                <input type="submit" name="submit" value="Add Review" />
            </form>
        </section>
    </article>

    <?php
} else {
    echo 'You are not logged in <a href="login.php"><button>Login Now!</button></a>';
}
?>