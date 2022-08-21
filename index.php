
<?php include 'head.php'; 
      include_once 'config/database.php';
?>
<body>
  <div class="wrapper"> 
    <section class="section-1 hero-section">
      
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
      <div class="hero-content homeBannerContent">
        <figure class="logo-figure"><img class="main-logo" src="images/main-logo.png" alt="" /></figure>
        <button class="btn-large">Find a farmer in your area</button>
        <div class="farmer-search">
            <form>
                <div class="search-form-row align-items-center">
                  <div class="search-form-col">
                        <input type="text"  placeholder="Search by Farmer Name" class="form-control farmer_name">
                  </div>
                  <div class="search-form-col">
                    <div class="select-custopm-row">
                        <select class="form-control state">
                            <option value="">Select State</option>
                            <?php foreach ($location['state'] as $key => $state) { 
                              echo "<option value =".$key.">".$state."</option>";
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
                                    echo "<option value =".$result['product'].">".$result['product']."</option>";
                                }
                            ?>
                        </select>
                      </div>
                  </div>
                    <button type="submit" class="theme-button search-form-btn submit">View All Farmers</button>
                </div>
              </form>
        </div>
      </div>

      </div>
</section>

<section class="mid-sec ptb-6">
  <div class="container">
    <div class="title-row">
      <figure><img class="title-icon" src="images/title-img.png" alt="" /></figure>
      <h1>Choose Best from the best Farms Near You</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
        cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>

    <div class="ChooseBest-frm">
      <ul class="ChooseBest-list">
          <?php
            $sql="select product ,product_image from products WHERE deleted != 1 GROUP BY product ";

            $query=mysqli_query($conn,$sql);
            if($query)
            {
                $tempp =array();
                while($rows= mysqli_fetch_array($query,MYSQLI_ASSOC))
                {
                    echo "<li><a '#'><figure><img class='farm-img' src='admin/company_logo/".$rows['product_image']."' alt='' /></figure><h2>".$rows['product']."</h2></a></li>";

                }
            }
          ?>
      </ul>

      <div class="discover-row">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
        ut labore et dolore magna aliqua. Ut enim ad minim veniam, <br />quis nostrud exercitation ullamco 
        laboris nisi ut aliquip ex ea commodo consequat.
      </div>

      <a class="theme-button bdr-green" href="#">Discover All Categories</a>

    </div>

  </div>
</section>

<section class="new-farmers">
  <div class="container">
    <div class="new-farmers-form">
      <h4>Our New<br>
        Farmers... </h4>
        <div class="farmers-form">
        <form>
          <div class="form-group">
            <div class="select-custopm-row">
            <select class="form-control state" id='state'>
                <option value="">Select State</option>
                <?php foreach ($location['state'] as $key => $state) { 
                  echo "<option value =".$key.">".$state."</option>";
                 } ?>
            </select>
          </div>
          </div>
          <div class="form-group">
            <div class="select-custopm-row">
                <select class="form-control city" id="city">
                    <option value="">Select Area</option>
                </select>
          </div>
          </div>
          <div class="form-group">
            <div class="select-custopm-row">
            <select class="form-control product" id='product'>
                <option value="">What would like to buy ?</option>
                <?php
                    $sql="select product ,product_id from products WHERE deleted != 1 GROUP BY product";
                    $query=mysqli_query($conn,$sql);
                    while($result=mysqli_fetch_array($query))
                    {
                        echo "<option value =".$result['product'].">".$result['product']."</option>";
                    }
                ?>
            </select>
            </div>
          </div>
            <button type="submit" id='submit' class="theme-button search-form-btn submit">View All Farmers</button>
        </form>
        </div>
    </div>
      
        <div class="farmers-slide owl-carousel owl-theme">
             <?php
                    $sql="select company_logo,company_id from company WHERE deleted = 0";
                    $query=mysqli_query($conn,$sql);
                    $product = '';
                    if($query)
                    {
                        while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                        {
                            echo "<div class='item'><a href='farmer-details.php?id=".$row['company_id']."&product=".$product."'><figure><img src='admin/company_logo/".$row['company_logo']."'  ></figure></a></div>";
                        }
                    }
                    
                ?>
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
<script>
$(document).ready(function(){
    $('.state').on('change',function() {
        var state = $(this).val();
        if(state == '')
        {
            $('.city').empty();
        }
        $.ajax({
            type: "POST",
            url: "mapping_data.php",
            data: {
            state : state
            } 
        }).done(function(data){
            var json = JSON.parse(data)
            var cityStr = '';
            
            $.each(json,function (index, row)
            {
                cityStr += "<option value='"+index+"'>"+row+"</option>";

            });
            $('.city').html(cityStr);
        });
    });
    $('.submit').click(function(e) {
    e.preventDefault();
    var state = $(".state option:selected").val();
    var city = $(".city option:selected").val();
    var product = $(".product option:selected").val();
    var farmer_name = $('.farmer_name').val();
     if((state != '' && city != '' && product != '' )|| (farmer_name != ''))
     {
         window.location = "search-results.php?state="+state+"&city="+city+"&product="+product+"&farmer_name="+farmer_name+"";
     }
    });
    
    $('#submit').click(function(e) {
    e.preventDefault();
    var state = $("#state option:selected").val();
    var city = $("#city option:selected").val();
    var product = $("#product option:selected").val();
    var farmer_name = $('.farmer_name').val();
    if(state == '')
        {
            $('#city').empty();
        }
    
     if((state != '' && city != '' && product != '' )|| (farmer_name != ''))
     {
         window.location = "search-results.php?state="+state+"&city="+city+"&product="+product+"&farmer_name="+farmer_name+"";
     }
    });
})
</script>
<?php include 'foot.php'; ?>