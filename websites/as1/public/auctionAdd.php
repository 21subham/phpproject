<?php
session_start();
require 'header.php';
if (isset($_SESSION['username'])) {
    include_once('dbConn.php');

    if (isset($_POST['submit'])) {
        $Pname = $_POST['productName'];
        $date = $_POST['enddate'];
        $desc = $_POST['Desc'];
        $category = $_POST['categories'];
        $price = $_POST['price'];
        $userID = $_SESSION['userID'];


        $AddAuctionQuery = $conn->prepare("INSERT INTO `auctions`(`Product_Name`, `endDate`, `description`, `categoryId`,`price`,`user_id`) VALUES ('$Pname','$date','$desc','$category','$price','$userID')");
        $AddAuctionQuery->execute();
    }
    ?>


    <body>
        <main>
            <form action='#' method='POST'>
                <label for='productName'>Prouct name</label>
                <input type='text' name='productName' required><br>
                <label for='Desc'>Description</label>
                <textarea name='Desc' id='desc' cols='10' rows='5' maxlength='255' required></textarea>
                <label for='enddate'>Date</label>
                <input type='date' name='enddate' required><br>
                <label for='price'>Price</label>
                <input type='text' name='price' required><br>
                <select name='categories'>

                    <?php
                    //categories
                    array_map(function ($categories) {
                        $categoryName = $categories['name'];
                        echo '<option value="' . $categoryName . '">' . $categoryName . '</option>';
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