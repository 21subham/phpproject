<?php
session_start();
require 'header.php';
if (isset($_SESSION['username'])) {
    include_once('dbConn.php');

    if (isset($_POST['submit'])) {
        $Pname = $_POST['title'];
        $date = $_POST['auction_end_date'];
        $desc = $_POST['description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $userID = $_SESSION['userID'];


        $AddAuctionQuery = $conn->prepare("INSERT INTO `auction`(`Car_Name`, `endDate`, `description`, `categoryId`,`price`,`user_id`) VALUES ('$Pname','$date','$desc','$category','$price','$userID')");
        $AddAuctionQuery->execute();
    }
    ?>


    <body>
        <main>
            <form action='#' method='POST'>
                <label for='title'>Prouct name</label>
                <input type='text' name='title' required><br>
                <label for='description'>Description</label>
                <textarea name='description' id='description' cols='10' rows='5' maxlength='255' required></textarea>
                <label for='auction_end_date'>Date</label>
                <input type='date' name='auction_end_date' required><br>
                <label for='price'>Price</label>
                <input type='number' name='price' required><br>
                <select name='category'>

                    <?php
                    //categories
                    array_map(function ($categories) {
                        $categoryName = $categories['name'];
                        echo '<option value="' . $categoryName . '"  name="category">' . $categoryName . '</option>';
                    }, $getCategory);
                    ?>

                </select><br>
                <button type='submit' value='submit' name='submit'>Submit</button>
            </form>


            <?php
            if (isset($_POST['submit'])) {
                echo "Auction Added Successfully";
            }
            ?>

        </main>
    </body>
    <?php
} else {
    echo 'Please login first <a href="login.php"><button>Login Now!</button></a>';
}
require 'footer.php';
?>