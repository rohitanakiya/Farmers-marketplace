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
<?php

    include_once 'config/config.php';
    include_once 'config/database.php';
    
    $state = $_GET["state"];
    $city = $_GET["city"];
    $product = $_GET["product"];
    $farmer_name = $_GET["farmer_name"];
?>
</head>
<body>

  <div class="wrapper"> 
    <section class="section-1 inner-bg inner-man-sec">
      
      <div class="container">
        <header class="header">
          <div class="header-left">
            <a class="theme-button" href="#">Join Us as farmer</a>
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
                    <input type="text"  placeholder="Search by Farmer Name" class="form-control farmer_name" value="<?php echo $_GET['farmer_name'] ;?>">
                  </div>
                  <div class="search-form-col">
                    <div class="select-custopm-row">
                        <select class="form-control state">
                            <option value=''>Select State</option>
                            <?php 
                            
                            foreach ($location['state'] as $key => $states) { 
                                $selected = ($key== $state) ? "selected" : "";
                              echo "<option $selected value =".$key." id='state' class =".$states.">".$states."</option>";
                             } ?>
                        </select>
                      </div>
                  </div>
                  <div class="search-form-col">
                    <div class="select-custopm-row">
                        <select class="form-control city">
                            <option value="">Select Area</option>
                        </select>
                      </div>
                  </div>
                  <div class="search-form-col">
                    <div class="select-custopm-row">
                        <select class="form-control product">
                            <option value="">What would like to buy ?</option>
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
                    <button class="theme-button search-form-btn" id="submit">View All Farmers</button>
                </div>
              </form>
        </div>
      </div>

      </div>
</section>

<section class="mid-sec ptb-6">
  <div class="container">
    <div class="title-row">
        <h1>Farmers in <span class="selectstate"></span> at <span class="selectcity"></span> for <br />
            <span class="selectproduct"></span> &amp; Natural Products</h1>
    </div>

    <div class="searchresult-wrap">
      <ul class="searchresult-list">
          
      </ul>
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
<script src="js/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var city = '<?php echo $city;?>';
    $('.title-row').hide();
    $('.state').on('change',function(e) {
        e.preventDefault();
        var state = $(this).val();
        if(state == '')
        {
            $('.city').empty();
        }
        selectcity();
    });
    selectcity();
    function selectcity()
    {
        var state = $('.state').val();
        $.ajax({
            type: "POST",
            url: "mapping_data.php",
            data: {
            state : state
            } 
        }).done(function(data){
        
           if(data != '')
           {
            var json = JSON.parse(data)
            var cityStr = '';
            if(json != null){
                $.each(json,function (index, row)
                {
                    var selected = (index == city) ? 'selected':" ";
                    cityStr += "<option value='"+index+"' "+selected+">"+row+"</option>";

                });
                $('.city').html(cityStr);
                selectprodcut();
            }
        }
        });
        
    }
    
    
    selectprodcut()
    function selectprodcut()
    {
        var product = $('.product option:selected').val();
        var state = $('.state option:selected').val();
        var city = $('.city option:selected').val();
        var farmer_name = $('.farmer_name').val();
           $.ajax({
               type: "POST",
               url: "mapping_product.php",
               data: {
               product : product,
               state : state,
               city : city,
               farmer_name : farmer_name
               } 
           }).done(function(data){
               if(data != '')
               {
                   var json = JSON.parse(data);
                   var companyStr = '';
                   $(json).each(function (index, row)
                   {
                       companyStr += "<li><a href='farmer-details.php?id="+row['company_id']+"&product="+product+"'><figure><img src='admin/company_logo/"+row['company_logo']+"' ></figure><div class='text-center'><h3>"+row['company']+"</h3><p>"+row['address']+"</p><p>"+row['city']+"</p><p>"+row['state']+"</p></li>";   
                   });
                   if(companyStr != '')
                   {
                    $('.searchresult-list').html(companyStr);
                   }
                   else
                   {
                       $('.searchresult-list').html('No matches found ');
                   }
               }
               submit();
           });
           
           
    }
    
    $('#submit').click(function(e) {
        e.preventDefault();
        submit();
        selectprodcut();
    });
    function submit()
    {
        var state = $(".state option:selected").text();
        var city = $(".city option:selected").text();
        var product = $(".product option:selected").text();
        var farmer_name = $('.farmer_name').val();
        if(state == '')
        {
            $('.city').empty();
        }
        $('.selectstate').html(state)
        $('.selectcity').html(city)
        $('.selectproduct').html(product)

        if(farmer_name != '')
        {
            $('.title-row').hide();
        }
        else
        {
           if(state != '' && city != '' && product != '')
            {
                $('.title-row').show();
            }
        }  
        
    }
    
})
</script>
<!-- Google CDN jQuery with fallback to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>