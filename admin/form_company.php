<?php if (!isset($_SERVER["HTTP_X_PJAX"])) { 
    include 'block.head.php'; ?>
    </head>
    <body class="">
<?php  }  ?>

<?php 
    include_once 'config/database.php';
    include_once 'config/config.php';

        $errors = array();
    $company =  $company_logo = $email = $contact_number = $website = $state = $city =  '';
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST['company'])){
            $errors['company'] = "Company name is required";
        }else{
            $com = form_validation($_POST['company']);
            $sql = "select company from company WHERE company = '$com' and deleted != 1";
            $query = mysqli_query($conn, $sql);
            $row=mysqli_num_rows($query);
            if($row  == 0)
            {
                $company = form_validation($_POST['company']);
            }
            else {
                $errors['company'] = "Company name already exists";
            }
        }
        if(empty($_POST['email'])){
            $errors['email'] = "Email address is required";
        }else{
                $email = form_validation($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format";
            }
        }
        if(empty($_POST['contact_number'])){
            $errors['contact'] = "Contact number name is required";
        }else{
            $contact_number = form_validation($_POST['contact_number']);
            
        }
        if(empty($_POST['website'])){
            $errors['website'] = "Website name is required";
        }else{
            $website = form_validation($_POST['website']);
        }
        if(empty($_POST['state'])){
            $errors['state'] = "State is required";
        }else{
            $state = form_validation($_POST['state']);
        }
        if(empty($_POST['city'])){
            $errors['city'] = "City is required";
        }else{
            $city = form_validation($_POST['city']);
        }
        if(empty($_FILES["company_logo"]["name"])){
            $errors['company_logo'] = "Company logo is required";
        }else{
            $company_logo =  date("ymhds")."_".$_FILES["company_logo"]["name"];
            $filesize = $_FILES['company_logo']['size'];
            $tempname = $_FILES['company_logo']['tmp_name'];
            $folder = "company_logo/".$company_logo ;
    //        print_r($_POST);exit;
            move_uploaded_file($tempname,$folder);
        }
        if(empty($errors)){
            $company_random_id = uniqid();
            $address = form_validation($_POST['address']);
            $description = form_validation($_POST['description']);
            
            $sql = "INSERT INTO company (company,company_random_id,company_logo,email,address,contact_number,website,state,city,description)
                   VALUES ('$company','$company_random_id','$company_logo','$email','$address','$contact_number','$website','$state','$city',$description)";

           if (mysqli_query($conn, $sql))
           {
                echo "<script>window.location = 'company.php'; </script>";
           }
            else 
           {
               echo "Error: " . $sql . "
               " . mysqli_error($conn);
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
<div class="wrapper">
    <form class="bs-example form-horizontal" enctype="multipart/form-data" method="post"> 
    <div class="row">
        <!-- left column -->
        <div class="col-md-8">                        
            <section class="panel panel-default">
                <header class="panel-heading font-bold bg-light dk">Company Detail</header>
                <div class="panel-body">   
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company *
                        </label>
                        <div class="col-lg-9">
                            <input name="company" id="company" type="text" class="form-control" value="<?php echo empty($_POST['company'])?'':$_POST['company'] ?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['company'])) ? $errors['company'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email *
                        </label>
                        <div class="col-lg-9">
                            <input name="email" id="company" type="text" class="form-control" value="<?php echo empty($_POST['email'])?'':$_POST['email'] ?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['email'])) ? $errors['email'] : '';?></span>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Website *
                        </label>
                        <div class="col-lg-9">
                            <input name="website" id="company" type="text" class="form-control" value="<?php echo empty($_POST['website'])?'':$_POST['website'] ?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['website'])) ? $errors['website'] : '';?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">State *
                        </label>
                        <div class="col-lg-9">
                          <select name="state" class="form-control state">
                              <option value="<?php echo empty($_POST['state'])?'':$_POST['state'] ?>">Select State</option>
                              <?php foreach ($location['state'] as $key => $state) { 
                                  $selected = $_POST['state'] == $key ? 'selected' : '';
                                echo "<option value =".$key." $selected>".$state."</option>";
                               } ?>
                          </select>
                          <span class = "error" style="color: red"><?= (isset($errors['state'])) ? $errors['state'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">City *
                        </label>
                        <div class="col-lg-9">
                            <select name="city" class="form-control city">
                            <option value="<?php echo empty($_POST['city'])?'':$_POST['city'] ?>">Select Area</option>
                          </select>
                          <span class = "error" style="color: red"><?= (isset($errors['city'])) ? $errors['city'] : '';?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Contact Number *
                        </label>
                        <div class="col-lg-9">
                            <input name="contact_number" id="company" type="text" class="form-control" value="<?php echo empty($_POST['contact_number'])?'':$_POST['contact_number'] ?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['contact'])) ? $errors['contact'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Description 
                        </label>
                        <div class="col-lg-9">
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Address 
                        </label>
                        <div class="col-lg-9">
                            <input name="address" id="company" type="text" class="form-control" value="" autocomplete="off"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company logo *
                        </label>
                        <div class="col-lg-9">
                            <input type="file" name="company_logo"class="custom-file-input" id="customFile">
                            <span class = "error" style="color: red"><?= (isset($errors['company_logo'])) ? $errors['company_logo'] : '';?></span>
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
  <script>
$(document).ready(function(){
    
    function selectcity(){
        var city ='<?php echo $_POST['city']?>';
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
            $.each(json,function (index, row)
            {
                selected = (index == city) ? 'selected' : " ";
                cityStr += "<option value='"+index+"' "+selected+">"+row+"</option>";

            });
            $('.city').html(cityStr);
        });
    }
    
    $('.state').on('change',function() {
       selectcity()
    });
    selectcity()
})
</script>  
<?php 
if (!isset($_SERVER["HTTP_X_PJAX"]) )
{
   include 'foot.php'; 
}
?>
