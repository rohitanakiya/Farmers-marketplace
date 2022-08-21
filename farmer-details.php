<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Farm The Farmer</title>
<!-- custom scrollbar stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/owl.carousel.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">
<link rel="stylesheet" href="js/select2/select2.css" type="text/css"/>
<link rel="stylesheet" href="js/select2/select2-bootstrap.css" type="text/css"/>
<script src="js/jquery.min.js"></script>

<?php

    include_once 'config/config.php';
    include_once 'config/database.php';
    
    $id = $_GET["id"];
    $product = ($_GET["product"])?$_GET["product"]:'';
    
    $sql = "select company,state,city, company_logo, contact_number, address, website, email from company"
            . " WHERE company_id = $id";
   
    $query = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($query);
    
        if($row > 0){
            while ($data = mysqli_fetch_assoc($query)) {
                $company_name = $data['company'];
                $company_logo = $data['company_logo'];
                $state = $data['state'];
                $city = $data['city'];
                $address = $data['address'];
                $contact_number = $data['contact_number'];
                $farmer_email = $data['email'];
                $website = $data['website'];
            }   
        }
        if($state != '')
        {
            $selectstate =  $location['state'][$state];
        }
        
        if($city != '')
        {
            $selectcity =  $location['city'][$state][$city];
        }
?>

<?php 

    $selectstate = $location['state'][$state];
    $selectcity = $location['city'][$state][$city];
    
$from_email ='';
    if(isset($_POST['save']))
    {        
        $errors = array();
        if(empty($_POST['from_email'])){
            $errors['from_email'] = "Email is required";
        }else{
            $from_email = form_validation($_POST['email']);
            
            $sql = "select email from emails WHERE from_email = '$from_email' and deleted != 1";
            $query = mysqli_query($conn, $sql);
            $row=mysqli_num_rows($query);
            if($row  == 0)
            {
                $from_email = form_validation($_POST['from_email']);
               
            }else {
                 $errors['from_email'] = "Email already exists";
            }
        }
        
        if(empty($_POST['full_name'])){
            $errors['full_name'] = "full name is required";
        }else{
            $full_name = form_validation($_POST['full_name']);
        }
        
        if(empty($_POST['contact_number'])){
            $errors['contact_number'] = "contact number is required";
        }else{
            $contact_number = form_validation($_POST['contact_number']);
        }
        
        if(empty($_POST['full_address'])){
            $errors['full_address'] = "full address is required";
        }else{
            $full_address = form_validation($_POST['full_address']);
        }
        
        if(empty($_POST['quantity'])){
            $errors['quantity'] = "product id is required";
        }
        else{
            $product_id = array();
            foreach($_POST['quantity'] as $key => $value)
            {   
                if($value!="")
                {
                    $products = form_validation($_POST['product'][$key]);
                    $quantity = form_validation($value);
                    $unit = form_validation($_POST['unit'][$key]);
                    $productbody .= $products.' = '. $quantity.''.$unit;
                    $productbody .= '<br>';
                }
            }
        
        }
        $to_email = $farmer_email;
        $to_id = $id;
        $subject = 'send mail for order place';
        $body= '<b>Products</b><br>'.$productbody;
           
        if(empty($errors))
        {
            $description  = $_POST['description'];
            $sql = "INSERT INTO emails (from_email, full_name, contact_number, full_address, `to_email`, to_id, subject, body,queries)
                   VALUES ('$from_email', '$full_name', '$contact_number', '$full_address', '$to_email', '$to_id', '$subject', '$body','$description')";
            if (mysqli_query($conn, $sql))
            {
                echo "<script>window.location = 'farmer-details.php?id=$id'; </script>";
            }
             else 
            {
                echo "Error: " . $sql . "
                " . mysqli_error($conn);
            }
            $sender_mail = 'test.codegarage@gmail.com';
            $sender_password = 'Code@123';
            
            require 'phpmailkit/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $sender_mail;                       // SMTP username
            $mail->Password = $sender_password;                   // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
            // TCP port to connect to
            $mail->setFrom($from_email, 'order place');
            $mail->addAddress($to_email);
            // Add a recipient
            // Name is optional
            $mail->addReplyTo($from_email);
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $subject;
            $mail->Body = $body;

            if (!$mail->send()) {
                echo "<script>alert('Mail was not sent!'); window.location = 'farmer-details.php?id=$id'; </script>";
            } else {
                echo "<script>alert('order placed successful.'); window.location = 'farmer-details.php?id=$id'; </script>";
            }
        }
        
    }
    function form_validation($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
</head>
<body>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Place Your Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="images/close.png" alt="" /></span>
          </button>
        </div>
        <div class="modal-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <div class="order-form">
            <form class="bs-example form-horizontal" enctype="multipart/form-data" method="post">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="full_name"  placeholder="Full Name" required>
                  </div>
                  <div class="form-group col-md-6">
                      <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" required>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="from_email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="full_address" placeholder="Full Address">
                    </div>
                  </div>
                <div class="form-group">
                  <textarea class="form-control" name="description" placeholder="Notes"></textarea>
                </div>
          <div class="order-table-wrap order-form">
            <h3>What you like to order?</h3>
            <div class="order-table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quanity</th>
                    <th scope="col">Cost</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="select product, product_id,price from products WHERE company_id = $id and deleted != 1 GROUP BY product";
                        $query=mysqli_query($conn,$sql);
                        while($result=mysqli_fetch_array($query))
                        {
                            echo "<tr><td scope='row' >".$result['product']."</td><td class='price'>".$result['price']."</td><td><div class='qty-col'>"
                                    . "<div class='qty-inp'><input name='product[]' class='form-control' type='hidden' placeholder=''multiple='multiple' value=".$result['product'].">"
                                    . "<input name='quantity[]' class='form-control quantity' type='text' placeholder=''multiple='multiple'></div>"
                                    . "<div class='qty-select'><select class='form-control' name ='unit[]'>"
                                    . "<option>Kg</option><option>Pkt</option><option>Ltr</option></select></div>"
                                    . "</div></td><td class='cost' cost='0'>$00.00</td></tr>";
                        }
                    ?>
                </tbody>
              </table>
            </div>
            <div class="grand-totle">
              Grand Total: <span id="grandtotal">$00.00</span> 
            </div>
            </div>
                <div class="placeOrder"><button type="submit" name="save" class="theme-button btn-green">Place Order</button></div>
              </form>
          </div>
        </div>
    </div>
    </div>
  </div>
<!-- Modal -->

  <div class="wrapper"> 
    <section class="section-1 inner-bg inner-man-sec">
      
      <div class="container">
        <header class="header">
          <div class="header-left">
            <a class="theme-button" href="how-it-works.html">Join Us as farmer</a>
          </div>
          <div class="header-right">
              <a class="theme-button btn-liner mr-2" href="faq.html">FAQ</a>
              <a class="theme-button" href="contact-us.php">Contact Us</a>
          </div>
      </header>
      <div class="hero-content">
        <figure class="logo-figure"><img class="main-logo" src="images/main-logo.png" alt="" /></figure>
        
        <div class="farmer-search">
            <form>
                <div class="search-form-row align-items-center">
                  <div class="search-form-col">
                    <input type="text" placeholder="Search by Farmer Name" class="form-control" >
                  </div>
                  <div class="search-form-col">
                    <div class="select-custopm-row">
                        <select class="form-control state" >
                            <option>Select State</option>
                            <?php foreach ($location['state'] as $key => $states) {
                                $selected = ($key== $state) ? "selected" : "";
                              echo "<option value =".$key." $selected>".$states."</option>";
                             } ?>
                        </select>
                      </div>
                  </div>
                  <div class="search-form-col">
                    <div class="select-custopm-row">
                        <select class="form-control city" >
                          <option>Select Area</option>
                        </select>
                      </div>
                  </div>
                  <div class="search-form-col">
                    <div class="select-custopm-row">
                        <select class="form-control product" >
                            <option>What would like to buy ?</option>
                            <?php
                                $sql="select product ,product_id from products WHERE deleted != 1 GROUP BY product";
                                $query=mysqli_query($conn,$sql);
                                while($result=mysqli_fetch_array($query))
                                {
                                    $selected = ($result['product']== $product) ? "selected" : "";
                                    echo "<option $selected value =".$result['product'].">".$result['product']."</option>";
                                }
                            ?>
                        </select>
                      </div>
                  </div>
                    <button  class="theme-button search-form-btn"><a style="color:white;" href="search-results.php" >View All Farmers</a></button>
                </div>
              </form>
        </div>
      </div>

      </div>
</section>

<section class="mid-sec ptb-6">
  <div class="container">
    <div class="farm-detail-wrap">
        <div class="farm-detail-row d-flex">
            <figure><img class="farmer-img" src="admin/company_logo/<?php echo $company_logo ?>" alt="" /></figure>
            <div class="farm-detail">
                <h3><?php echo $company_name ?></h3>
                <p><?php echo $address ?></p>
                <p>Location, <span> <?php echo $selectcity ;?>.</span> <span ><?php echo $selectstate ;?></span></p>

                <div class="farm-contact-row">
                    <div class="farm-contact-col">
                        <i><img src="images/call.png" alt="" /></i>
                        <a href="<?php echo $contact_number ?>"><?php echo $contact_number ?></a>
                    </div>
                    <div class="farm-contact-col">
                        <i><img src="images/email.png" alt="" /></i>
                        <a href="<?php echo $farmer_email ?>"><?php echo $farmer_email ?></a>
                    </div>
                    <div class="farm-contact-col">
                        <i><img src="images/web.png" alt="" /></i>
                        <a href="<?php echo $website ?>"><?php echo $website ?></a>
                    </div>
                </div>
                <button class="theme-button placeorder-btn" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">Place Your Order</button>
            </div>
    </div>

    <div class="farm-menu-img"><img src="images/menu.jpg" alt="" /></div>
    <button class="theme-button placeorder-btn2" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">Place Your Order</button>
    </div>

    <div class="searchresult-wrap">
        <div class="title-row text-center">
            <h2>Similar Farmers Near You</h2>
          </div>
        <ul class="searchresult-list">
          <?php
                    $sql="select company_logo,company,address,state,city,company_id from company WHERE state ='". $state."' and company_id != $id and deleted = 0";
                    // print_r($sql);exit;
                    $query=mysqli_query($conn,$sql);
                    if($query)
                    {
                        while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                        {
                            $selectstate = $location['state'][$state];
                            $city = $location['city'][$state][$row['city']];
                            
                            echo "<li><a href='farmer-details.php?id=".$row['company_id']."&product=".''."'><figure><img class='farmer-img' src='admin/company_logo/".$row['company_logo']."'  ></figure>"
                                    . "<div><h3>".$row['company']."</h3>"
                                    . "<p>".$row['address'].""
                                    . "<p><span class=''>".$city."</span>, <span class=''>".$selectstate."</span></p>";
                        }
                    }
                    
                ?>
          
            </ul>
      </div>

      
          </div>
    </div>
</section>

<footer>
    <div class="disc-btn">
        <div class="container">
          <a href="#">Discover All Our Farmers</a>
          </div>
      </div>
  <div class="container">
    <div class="footer-content">
      <figure><img class="footer-logo" src="images/footer-logo.png" alt="" /></figure>
      <span class="copyright-text">© Copyright 2020 fromfarmertoyou.com.au</span>
    </div>
  </div>
</footer>

  </div>

<!-- Google CDN jQuery with fallback to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/select2/select2.js"></script>
<script>
    
    $(".product_select").select2();
    $(document).ready(function(){
    selectCIty();
    var state = $(".state option:selected").text();
    $('.selectstate').html(state);
    
    function selectCIty() {
        var city = '<?php echo $city;?>';
        var state = $('.state').val();
        $.ajax({
            type: "POST",
            url: "mapping_data.php",
            data: {
            state : state
            } 
        }).done(function(data){
            var json = JSON.parse(data)
            var cityStr = '';
            if(json != null)
            {
                $.each(json,function (index, row)
                {
                    selected = (index == city) ? 'selected':" ";
                    cityStr += "<option value='"+index+"' "+selected+">"+row+"</option>";

                });
                $('.city').html(cityStr);
            };
        var selectcity = $(".city option:selected").text();
        $('.selectcity').html(selectcity);
        })
    }
    
    $('.state').on('change',function() {
        selectCIty();
    });
    $('.quantity').on('change',function() 
    {
        var quantity = $(this).val();
        var price = $(this).closest("tr").find(".price").text();
        var cost = quantity*price ;
        $(this).closest("tr").find(".cost").html("$"+ cost.toFixed(2));
        $(this).closest("tr").find(".cost").attr("cost",cost);
        grandtotal()
    });
    function grandtotal()
    {
        var total = parseFloat(0);
        $( ".cost" ).each(function( index ) 
        {            
            total += parseFloat($(this).attr("cost"));
        });
        
        $("#grandtotal").html("$"+total.toFixed(2));
    }
    })
</script>
</body>
</html>