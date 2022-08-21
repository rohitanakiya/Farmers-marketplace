<?php if (!isset($_SERVER["HTTP_X_PJAX"])) {  ?>
</head>
<body class="">
<?php include 'block.head.php'; ?>
<?php } 

    include_once 'config/database.php';

    $product =  $category_id = $company_id =  $price = '';

    if(isset($_POST['save']))
    {	
        $errors = array();
        if(empty($_POST['product'])){
            $errors['product'] = "Product name is required";
        }else{
            $id = $_GET['id'];
            $pro = form_validation($_POST['product']);
            $company = form_validation($_POST['company_id']);
            $sql = "select product from products WHERE product = '$pro' and product_id != '$id' and company_id='$company' and deleted != 1";
            $query = mysqli_query($conn, $sql);
            $row=mysqli_num_rows($query);
            if($row  == 0)
            {
                $product = form_validation($_POST['product']);
            }else {
                 $errors['product'] = "Product name already exists";
            }
        }
        if(empty($_POST['category_id'])){
            $errors['category_id'] = "Category name is required";
        }else{
            $category_id = form_validation($_POST['category_id']);
        }
        if(empty($_POST['company_id'])){
            $errors['company_id'] = "Company name is required";
        }else{
            $company_id = form_validation($_POST['company_id']);
        }
        if(empty($_POST['price'])){
            $errors['price'] = "Price id is required";
        }else{
            $price = form_validation($_POST['price']);
        }
        if(empty($errors))
        {
            $description = form_validation($_POST['description']);
            if(!empty($_FILES["product_image"]["name"]))
            {
                $product_image =  date("ymhds")."_".$_FILES["product_image"]["name"];
            }else {
                $product_image =  $_GET['product_image'];
            }
            $filesize = $_FILES['product_image']['size'];
            $tempname = $_FILES['product_image']['tmp_name'];
            $folder = "company_logo/".$product_image ;
            move_uploaded_file($tempname,$folder);

            $sql=" UPDATE `products` SET `product_id`='$id',`product`='$product',`category_id`='$category_id',`company_id`='$company_id',`price`='$price',`description`='$description',`product_image`='$product_image' WHERE product_id = $id"; 
            if (mysqli_query($conn, $sql))
            {
                echo "<script>window.location = 'products.php'; </script>";
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
                    <header class="panel-heading font-bold bg-light dk">Product Detail</header>
                    <div class="form-group required">
                        <label class="col-lg-3 control-label">Company *</label>
                        <div class="col-lg-9">
                            <select name="company_id" id="category_id" class="form-control">
                                <option value="">SELECT</option>
                                <?php
                                $sql="select company ,company_id from company WHERE deleted != 1";
                                $query=mysqli_query($conn,$sql);
                                while($result=mysqli_fetch_array($query))
                                { 
                                    $selected = ($_GET['company_id'] == $result['company_id']) ? "selected" : '';
                                    echo "<option $selected value =".$result['company_id'].">".$result['company']."</option>";
                                }
                                ?>
                            </select>
                            <span class = "error" style="color: red"><?= (isset($errors['company_id'])) ? $errors['company_id'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group required">
                        <label class="col-lg-3 control-label">Category *</label>
                        <div class="col-lg-9">
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">SELECT</option>
                                <?php
                                $sql="select category ,id from categories WHERE deleted != 1";
                                $query=mysqli_query($conn,$sql);
                                while($result=mysqli_fetch_array($query))
                                {
                                    $selected = ($_GET['category_id'] == $result['id']) ? "selected" : '';
                                    echo "<option $selected value =".$result['id'].">".$result['category']."</option>";
                                }
                                ?>
                            </select>
                             <span class = "error" style="color: red"><?= (isset($errors['category_id'])) ? $errors['category_id'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Product *
                        </label>
                        <div class="col-lg-9">
                            <input name="product" id="category" type="text" class="form-control" value="<?php echo $_GET['product'] ;?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['product'])) ? $errors['product'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Price *
                        </label>
                        <div class="col-lg-9">
                            <input name="price" id="company" type="text" class="form-control" value="<?php echo $_GET['price'] ;?>" autocomplete="off"/>
                            <span class = "error" style="color: red"><?= (isset($errors['price'])) ? $errors['price'] : '';?></span>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Description 
                        </label>
                        <div class="col-lg-9">
                            <textarea name="description" class="form-control"><?php echo $_GET['description'] ;?></textarea>
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
