<?php 
    include_once 'config/config.php';
    include_once 'config/database.php';
    $product = $_POST["product"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $farmer_name = $_POST["farmer_name"];
    if(!empty($farmer_name))
    {
        $sql="select products.company_id,company.company,company.company_logo,company.city,company.state,company.address from products LEFT JOIN company ON products.company_id = company.company_id "
            . " WHERE company.company LIKE '%$farmer_name%' and products.deleted = 0 GROUP BY products.company_id";
    
        $query=mysqli_query($conn,$sql);
        if($query)
        {
            $tempp =array();
            while($rows= mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $city = $location['city'][$rows['state']][$rows['city']];
                $rows['state'] = $location['state'][$rows['state']];
                $rows['city'] = $city;
                $tempp[] = $rows;

            }

                echo json_encode($tempp);exit;
        }
    }
    if(!empty($product) && !empty($city) )
    {
        $sql="select products.company_id,company.company,company.company_logo,company.city,company.state,company.address from products LEFT JOIN company ON products.company_id = company.company_id "
                . " WHERE product = '$product' and company.city = '$city' and company.state = '$state' and products.deleted = 0 GROUP BY products.company_id";

        $query=mysqli_query($conn,$sql);
        if($query)
        {
            $tempp =array();
            while($rows= mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $city = $location['city'][$rows['state']][$rows['city']];
                $rows['state'] = $location['state'][$rows['state']];
                $rows['city'] = $city;
                $tempp[] = $rows;

            }

                echo json_encode($tempp);exit;
        }
    }
?>