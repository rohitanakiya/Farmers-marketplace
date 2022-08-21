<?php include_once 'config/config.php';
if($_POST["state"] != '')
{
    $country = $_POST["state"];
    $countr =  $location['city'][$country];
    echo json_encode($countr);exit;
}
?>