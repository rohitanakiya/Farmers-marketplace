<?php
include_once 'config/database.php';

    $id = $_GET['id'];
    $delete = '1';
    $sql=" UPDATE `categories` SET `deleted`='$delete' WHERE id = $id"; 
    $query = mysqli_query($conn,$sql);
    if($query)
    {
        header('location:categories.php');
    }
?>