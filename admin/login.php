<?php 
    session_start();
    
    if (isset($_SESSION['username'])) 
    {
        header("Location:index.php");

    }
    include 'config/database.php';
    
    if(isset($_POST['username']) && isset($_POST['password']))
    {
      $username = $_POST['username']  ;
      $password = $_POST['password']  ;
      
      $sql = "select * from users where user_name = '$username' and user_password = '$password'" ;
      
      $result = mysqli_query($conn,$sql);
      if(mysqli_num_rows($result) == 1){
          $_SESSION['username'] = $username;
          header("Location:index.php");
      }else{
          header("Location:login.php");
      }
    }
    ?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>farmer</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/login.css">
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<style>

</style>
</head>
<body>
<div class="login-form">
    <form action="#" method="post">
            <img src="images/logo.png" style="height: 100px;">
            <br><br>
            <div class="form-group has-error">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" style="background-color:#7d8d6a!important;">Log in</button>
        </div>
        <!--<p><a href="#">Forgot Password?</a></p>-->
    </form>
</div>
</body>
</html>