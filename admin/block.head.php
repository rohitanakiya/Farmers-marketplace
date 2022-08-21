<?php include 'head.php'; 
    $username= $_SESSION['username'];
?>
</head>
<body class="">
  <section class="vbox">
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md bg-white">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="images/logo.png" class="m-r-sm">From Farmer</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="thumb-sm avatar pull-left">
                    <img src="images/avatar_default.jpg">
                </span>
                <?php echo $username; ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
              <span class="arrow top"></span>
              <li>
                <a href="logout.php">Logout</a>
              </li>
            </ul>
        </li>
      </ul>  
    </header>
      <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-dark lter aside-md hidden-print hidden-xs" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="">
                        <a href="index.php"   class="active pjax-content-link">
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>Dashboard</span>
                      </a>
                    </li>
                    <li >
                      <a href="" class="">
                        <i class="fa fa-list">
                          <b class="bg-primary"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Products</span>
                      </a>
                      <ul class="nav lt">
                        <li>
                          <a href="products.php" class="active pjax-content-link">                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Products</span>
                          </a>
                        </li>
                        <li  class="">
                            <a href="categories.php"  class="active pjax-content-link">                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Categories</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li  class="">
                        <a href="company.php"   class="active pjax-content-link">
                        <i class="fa fa-building">
                          <b class="bg-info"></b>
                        </i>
                        <span>Companies</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer lt hidden-xs b-t b-dark">
              <div id="chat" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">Active chats</header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No active chats.</p>
                      <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
            </footer>
          </section>
        </aside>
        <div class="wrapper" id="content">