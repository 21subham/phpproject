<?php
session_start();
require 'header.php';


if (isset($_SESSION['username'])) {
    if ($_SESSION['userRole'] === "admin") {
        include_once('dbConn.php');


        $categoryList = array_map(function ($categories) {
            $categoryName = $categories['name'];
            $categoryID = $categories['category_id'];

            return '<li>' . $categoryName . '</li>
                    <a href="editCategories.php?categoryID=' . $categoryID . '">edit /</a>
                    <a href="deleteCategories.php?categoryID=' . $categoryID . '">delete</a>';
        }, $getCategory);

        // output the list items after join
        echo implode('', $categoryList);


    } else {
        echo 'Access Denied. You do not have admin access.';
    }
} else {
    echo 'Please login first <a href="login.php"><button>Login Now!</button></a>';
}
require 'footer.php';
