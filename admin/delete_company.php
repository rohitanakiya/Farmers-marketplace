<?php
include_once 'config/database.php';

    $id = $_GET['id'];
    $delete = '1';
    $sql=" UPDATE `company` SET `deleted`='$delete' WHERE company_id = $id"; 
    
    $query = mysqli_query($conn,$sql);
    if($query)
    {
        header('location:company.php');
    }
?>