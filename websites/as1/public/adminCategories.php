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
                  <button><a href="editCategory.php?categoryID=' . $categoryID . '">edit </a></button>
                   <button> <a href="deleteCategory.php?categoryID=' . $categoryID . '">delete</a></button>
                    <br> <br>';

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
