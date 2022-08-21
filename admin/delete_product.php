<?php
include_once 'config/database.php';

    $id = $_GET['id'];
    $delete = '1';
    $sql=" UPDATE `products` SET `deleted`='$delete' WHERE product_id = $id"; 
    $query = mysqli_query($conn,$sql);
    if($query)
    {
        header('location:products.php');
    }
?>