<?php if (!isset($_SERVER["HTTP_X_PJAX"])) {  include 'head.php';  ?>
</head>
<body class="">
<?php include 'block.head.php'; ?>
<?php } ?>
    
<?php
    include_once 'config/database.php';
    
    $first_name = $last_name = $email = $mobile_number = $address = '';
    
    if(isset($_POST['save']))
    {	 
        $first_name = form_validation($_POST['first_name']);
        $last_name = form_validation($_POST['last_name']);
        $email = form_validation($_POST['email']);
        $mobile_number = form_validation($_POST['mobile_number']);
        $address = form_validation($_POST['address']);
        $description = form_validation($_POST['description']);

       $sql = "INSERT INTO farmer_info (first_name,last_name,mobile_number,email,address,description)
               VALUES ('$first_name','$last_name','$mobile_number','$email','$address','$description')";

       if (mysqli_query($conn, $sql))
       {
           echo '<script>alert("New record created successfully")</script>'; 
       }
        else 
       {
           echo "Error: " . $sql . "
           " . mysqli_error($conn);
       }
    }
    
    function form_validation($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
?>
    <form id="user_need_Form" class="bs-example form-horizontal" enctype="multipart/form-data" method="post">    
    <div class="row">
        <!-- left column -->
        <div class="col-md-10">                        
            <section class="panel panel-default">
                <header class="panel-heading font-bold bg-light dk">Farmer Info</header>
                <div class="panel-body">  
                    <div class="form-group required">
                        <label class="col-lg-3 control-label">First name
                        </label>
                        <div class="col-lg-9">
                            <input name="first_name" id="title" type="text" class="form-control" value="" autocomplete="off" />
                        </div>
                    </div> 
                    <div class="form-group required">
                        <label class="col-lg-3 control-label">Last Name
                        </label>
                        <div class="col-lg-9">
                            <input name="last_name" id="title" type="text" class="form-control" value="" autocomplete="off" />
                        </div>
                    </div> 
                    <div class="form-group required">
                        <label class="col-lg-3 control-label">Email
                        </label>
                        <div class="col-lg-9">
                            <input name="email" id="title" type="text" class="form-control" value="" autocomplete="off" />
                        </div>
                    </div> 
                    <div class="form-group required">
                        <label class="col-lg-3 control-label">Mobile number
                        </label>
                        <div class="col-lg-9">
                            <input name="mobile_number" id="title" type="text" class="form-control" value="" autocomplete="off" />
                        </div>
                    </div> 
                    <div class="form-group required">
                        <label class="col-lg-3 control-label">Address
                        </label>
                        <div class="col-lg-9">
                            <input name="address" id="title" type="text" class="form-control" value="" autocomplete="off" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Description
                        </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div> 
                </div>
            </section> 
            <div class="form-buttons">
                <button class="btn btn-primary" name="save">Save</button>
            </div>
        </div>           
    </div> 
</form>
</div>
            <?php 
if (!isset($_SERVER["HTTP_X_PJAX"]) )
{
   include 'foot.php'; 
}
?>
