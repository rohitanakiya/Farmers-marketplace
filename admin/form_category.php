<?php if (!isset($_SERVER["HTTP_X_PJAX"])) {  ?>
</head>
<body class="">
<?php include 'block.head.php'; ?>
<?php } 

    include_once 'config/database.php';

        $errors = array();
    $category = '';

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {	 
        if(empty($_POST['category'])){
            $errors['category'] = "Category name is required";
        }else{
            $cat = form_validation($_POST['category']);
            $sql = "select category from categories WHERE category = '$cat' and deleted != 1";
            $query = mysqli_query($conn, $sql);
            $row=mysqli_num_rows($query);
            if($row  == 0)
            {
                $category = form_validation($_POST['category']);
            }
            else
            {
               $errors['category'] = "Category name already exists "; 
            }
        }
        if(empty($_FILES["category_image"]["name"])){
            $errors['category_image'] = "Product Image is required";
        }else{
            $category_image =  date("ymhds")."_".$_FILES["category_image"]["name"];
            $filesize = $_FILES['category_image']['size'];
            $tempname = $_FILES['category_image']['tmp_name'];
            $folder = "company_logo/".$category_image ;
    //        print_r($_POST);exit;
            move_uploaded_file($tempname,$folder);
        }
        if(empty($errors)){
            $category_random_id = uniqid();
            $sql = "INSERT INTO categories (category,category_random_id,category_image)
                   VALUES ('$category','$category_random_id','$category_image')";
        //       print_r($sql);exit;
           if (mysqli_query($conn, $sql))
           {
               echo "<script>window.location = 'categories.php'; </script>";
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
                <header class="panel-heading font-bold bg-light dk">Category Detail</header>
                <div class="panel-body">   
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Category *
                        </label>
                        <div class="col-lg-9">
                            <input name="category" id="category" type="text" class="form-control" value="<?php echo empty($_POST['category'])?'':$_POST['category'] ?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['category'])) ? $errors['category'] : '';?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Category Image *
                        </label>
                        <div class="col-lg-9">
                            <input type="file" name="category_image" class="custom-file-input" id="customFile">
                            <span class = "error" style="color: red"><?= (isset($errors['category_image'])) ? $errors['category_image'] : '';?></span>
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
