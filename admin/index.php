<?php if (!isset($_SERVER["HTTP_X_PJAX"])) { 
include 'block.head.php';?>
</head>
<body class="">
<?php   } ?>
    <section class="vbox bg-gradient content-vbox">
    <header class="header b-b b-t b-light bg-light lter">
        <p class="font-bold">Dashboard</p>
    </header>
    <section class="wrapper">
        <!--<div class="wrapper">-->
            <section class="panel panel-default panel-body">
                <div class="col-sm-6 col-md-6 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-primary"></i>
                      <i class="fa fa-building fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="company.php">
                      <span class="h3 block m-t-xs"><strong>1</strong></span>
                      <small class="text-muted text-uc">Total Companies</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-6 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-dark"></i>
                      <i class="fa fa-list fa-stack-1x text-white"></i>
                    </span>
                      <a class="clear" href="products.php">
                      <span class="h3 block m-t-xs"><strong id="bugs">2</strong></span>
                      <small class="text-muted text-uc">Total Products</small>
                    </a>
                  </div>
    
                </section>
            <!--</div>-->
        </section>
    </section>
    
<?php 
if (!isset($_SERVER["HTTP_X_PJAX"]) )
{
   include 'foot.php'; 
}
?>
