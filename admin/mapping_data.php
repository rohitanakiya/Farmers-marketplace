<?php include_once 'config/config.php';
    $country = $_POST["state"];
    $countr =  $location['city'][$country];
    echo json_encode($countr);exit;

?>