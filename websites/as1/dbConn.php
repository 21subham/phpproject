<?php

    $host = "localhost";
    $db_name = "assignment1";
     $username = "v.je";
     $password = "v.je";
    $conn;
 
   
      $conn = new PDO('mysql:dbname=assignment1;host=db', $username, $password,[PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION]);
 
        
    $getCategoryQuery = $pdo->prepare('SELECT * FROM category');
    $getCategoryQuery->execute();
    $getCategory = $getCategoryQuery->fetchAll();  
       
    

?>