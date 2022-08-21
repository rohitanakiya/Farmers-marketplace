<?php if (!isset($_SERVER["HTTP_X_PJAX"])) { include 'block.head.php'; ?>
</head>
<body class="">
<?php  } 

    include_once 'config/database.php';
    include_once 'config/config.php';

        $errors = array();
    $company =  $company_logo = $email = '';
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {	
        if(empty($_POST['company'])){
            $errors['company'] = "Company name is required";
        }else{
            $id = $_GET['id'];
            $com = form_validation($_POST['company']);
            $sql = "select company from company WHERE company = '$com' and company_id != $id and deleted != 1";
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
        if(empty($_POST['email'])){
            $errors['email'] = "Email address is required";
        }else{
                $email = form_validation($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format";
            }
        }
        if(empty($errors)){
            $id = $_GET['id'];
            $address = form_validation($_POST['address']);
            if(!empty($_FILES["company_logo"]["name"]))
            {
                $company_logo =  date("ymhds")."_".$_FILES["company_logo"]["name"];
            }else {
                $company_logo =  $_GET['company_logo'];
            }
            $filesize = $_FILES['company_logo']['size'];
            $tempname = $_FILES['company_logo']['tmp_name'];
            $folder = "company_logo/".$company_logo ;
            move_uploaded_file($tempname,$folder);
            
            $sql=" UPDATE company SET `company_id`='$id',`company`='$company',`email` = '$email',"
                . "`company_logo`='$company_logo',`address`='$address',`contact_number`='$contact_number',"
                . "`website`='$website' ,`state`='$state',`city`='$city' WHERE company_id = $id"; 

            $query=mysqli_query($conn,$sql);
            if ($query)
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
    <form id="categories_Form" class="bs-example form-horizontal" enctype="multipart/form-data" method="post"> 
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
                            <input name="company" id="category" type="text" class="form-control" value="<?php echo empty($_GET['company'])?'':$_GET['company'] ?>" autocomplete="off"/>
                             <span class = "error" style="color: red"><?= (isset($errors['company'])) ? $errors['company'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email *
                        </label>
                        <div class="col-lg-9">
                            <input name="email" id="company" type="text" class="form-control" value="<?php echo empty($_GET['email'])?'':$_GET['email'] ?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['email'])) ? $errors['email'] : '';?></span>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Website *
                        </label>
                        <div class="col-lg-9">
                            <input name="website" id="company" type="text" class="form-control" value="<?php echo empty($_GET['website'])?'':$_GET['website'] ?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['website'])) ? $errors['website'] : '';?></span>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-lg-3 control-label">State *</label>
                        <div class="col-lg-9">
                            <select name="state" id="state" class="form-control state" >
                            <option value="">Select State</option>
                              <?php foreach ($location['state'] as $key => $state) {
                                $selected = ($key== $_GET['state']) ? "selected" : "";
                                echo "<option value =".$key." $selected >".$state."</option>";
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
                            <option value="">Select Area</option>
                          </select><span class = "error" style="color: red"><?= (isset($errors['city'])) ? $errors['city'] : '';?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Contact Number*
                        </label>
                        <div class="col-lg-9">
                            <input name="contact_number" id="company" type="text" class="form-control" value="<?php echo empty($_GET['contact_number'])?'':$_GET['contact_number'] ?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['contact'])) ? $errors['contact'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Description 
                        </label>
                        <div class="col-lg-9">
                            <textarea name="description" class="form-control"><?php echo $_GET['description'] ;?></textarea>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Address
                        </label>
                        <div class="col-lg-9">
                            <input name="address" id="company" type="text" class="form-control" value="<?php echo empty($_GET['address'])?'':$_GET['address'] ?>" autocomplete="off"/>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Company logo
                        </label>
                        <div class="col-lg-9">
                            <input type="file" name="company_logo"class="custom-file-input" id="customFile">
                        </div>
                    </div> 
                </div>
            </section> 
            <div class="form-buttons">
                <button  class="btn btn-primary" name="save">Save</button>
            </div>
        </div>           
    </div> 
</form>
</div>
<script>
$(document).ready(function(){
    selectCIty();
    $('.state').on('change',function() {
        selectCIty();
    });
});
function selectCIty()
{
    var city ='<?php echo $_GET['city']?>';
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
</script>
    
<?php 
if (!isset($_SERVER["HTTP_X_PJAX"]) )
{
   include 'foot.php'; 
}
?>
