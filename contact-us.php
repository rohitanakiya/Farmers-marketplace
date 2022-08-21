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
include_once 'config/database.php';

        $errors = array();
$email =  $firstname = $lastname = $contact_number = $query = '';
    if(isset($_POST['send']))
    {        
        if(empty($_POST['email'])){
            $errors['email'] = "Email is required";
        }else{
                $email = form_validation($_POST['email']);
        }
        
        if(empty($_POST['firstname'])){
            $errors['firstname'] = "First name is required";
        }else{
            $firstname = form_validation($_POST['firstname']);
        }
        
        if(empty($_POST['lastname'])){
            $errors['lastname'] = "Last name is required";
        }else{
            $lastname = form_validation($_POST['lastname']);
        }
        
        if(empty($_POST['contact_number'])){
            $errors['contact_number'] = "contact number is required";
        }else{
            $contact_number = form_validation($_POST['contact_number']);
        }
        
        if(empty($_POST['query'])){
            $errors['query'] = "Your query is required";
        }else{
            $query = form_validation($_POST['query']);
        }
        
        $subject = 'send mail for query';
        $body= '<b>'.$query.'</b>';
        $admin= 'admin';
        
        if(empty($errors))
        {
            $sql = "INSERT INTO emails (from_email, full_name, contact_number, queries,farmer_type)
                   VALUES ('$email', '$firstname - $lastname', '$contact_number','$query' ,'$admin')";
                   
            if (mysqli_query($conn, $sql))
            {
                echo "<script>window.location = 'contact-us.php' </script>";
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
            $mail->Username = $email;                       // SMTP username
            $mail->Password = $sender_password;                   // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
            // TCP port to connect to
            $mail->setFrom($email);
            // Add a recipient
            // Name is optional
            $mail->addReplyTo($email);
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $subject;
            $mail->Body = $body;

            if (!$mail->send()) {
                echo "<script>alert('Mail was not sent!'); window.location = 'contact-us.php' </script>";
            } else {
                echo "<script>alert('Email send successfully.'); window.location = 'contact-us.php'; </script>";
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
<div class="wrapper">
  <section class="section-1 inner-bg inner-man-sec">
    <div class="container">
      <header class="header">
        <div class="header-left"> <a class="theme-button" href="how-it-works.html">Join Us as farmer</a> </div>
        <div class="header-right"> <a class="theme-button btn-liner mr-2" href="faq.html">FAQ</a> <a class="theme-button" href="#">Contact Us</a> </div>
      </header>
      <div class="hero-content">
        <figure class="logo-figure"><img class="main-logo" src="images/main-logo.png" alt="" /></figure>
        <h1>Contact us</h1>
      </div>
    </div>
  </section>
  <section class="mid-sec contact_wrapper ptb-6">
  <div class="container">
    <h2>Contact Us</h2>
    <ul class="contact_info">
      <li>
        <h6>Contact Number:</h6>
        <p>Sara Ergas: <a href="tel:0450-30-5274">0450 30 5274</a></p>
      </li>
      <li>
        <h6>Email address:</h6>
        <p><a href="mailto:ergas.sara123@farminfo.com">ergas.sara123@farminfo.com</a></p>
      </li>
      <li>
        <h6>Work time to call:</h6>
        <p>10:00-16:00 Sunday-Friday</p>
      </li>
      <li>
        <h6>Saturday Close for the office only</h6>
        <span>Every farmer have is on time</span>
      </li>
    </ul>
    <div class="contact_form">
      <div class="row">
        <div class="col-md-8 col-lg-6">
        <h2>You can send an email and we will get back to you as soon as possible</h2>
        <form class="bs-example form-horizontal" enctype="multipart/form-data" method="post">
          <div class="row">
       <div class="form-group col-sm-6">
              <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo empty($_POST['firstname'])?'':$_POST['firstname'] ?>">
              <span class = "error" style="color: red"><?= (isset($errors['firstname'])) ? $errors['firstname'] : '';?></span>
          </div>
          <div class="form-group col-sm-6">
              <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo empty($_POST['lastname'])?'':$_POST['lastname'] ?>">
            <span class = "error" style="color: red"><?= (isset($errors['lastname'])) ? $errors['lastname'] : '';?></span>
          </div>
          <div class="form-group col-sm-6">
              <input type="tel" class="form-control" name="contact_number" placeholder="Contact Number" value="<?php echo empty($_POST['contact_number'])?'':$_POST['contact_number'] ?>">
            <span class = "error" style="color: red"><?= (isset($errors['contact_number'])) ? $errors['contact_number'] : '';?></span>
          </div>
          <div class="form-group col-sm-6">
              <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php echo empty($_POST['email'])?'':$_POST['email'] ?>">
            <span class = "error" style="color: red"><?= (isset($errors['email'])) ? $errors['email'] : '';?></span>
          </div>
          <div class="form-group col-sm-12">
              <textarea class="form-control" rows="4" name="query" placeholder="Your Query" value="<?php echo empty($_POST['query'])?'':$_POST['query'] ?>"></textarea>
            <span class = "error" style="color: red"><?= (isset($errors['query'])) ? $errors['query'] : '';?></span>
          </div>
          <div class="col-sm-12 text-right">
            <input type="submit" name="send" class="theme-button" value="send">
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
<footer>
  <div class="disc-btn">
    <div class="container"> <a href="#">Discover All Our Farmers</a> </div>
  </div>
  <div class="container">
    <div class="footer-content">
      <figure><img class="footer-logo" src="images/footer-logo.png" alt="" /></figure>
      <span class="copyright-text">© Copyright 2020 fromfarmertoyou.com.au</span> </div>
  </div>
</footer>
</div>

<!-- Google CDN jQuery with fallback to local --> 
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>