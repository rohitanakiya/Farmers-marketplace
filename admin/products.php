<?php if (!isset($_SERVER["HTTP_X_PJAX"])) { ?>
</head>
<body class="">
<?php include 'block.head.php'; ?>
<?php } ?>
    <script type="application/javascript">
    $('document').ready(function(){
        $('#DataTables_List_company').DataTable({
            "bProcessing": true,
            "bSortable": false,
            "bJQueryUI": false,
            "sPaginationType": "full_numbers",
            "processing": true,
            "stateSave": true,
        }); 
    });
    </script>
        <?PHP
        include_once 'config/database.php';

        $sql="select products.product,products.product_id,products.category_id,products.description,products.price,"
            . "products.company_id,products.company_id ,categories.category,company.company from products "
            . "LEFT JOIN categories ON products.category_id = categories.id "
            . "LEFT JOIN company ON products.company_id = company.company_id "
            . "WHERE products.deleted != 1";
        
        $query=mysqli_query($conn,$sql);
        $row=mysqli_num_rows($query);
        
        ?>
            <div class="wrapper">
              <section class="panel panel-default" style="margin-top: 10px;">
              <header class="panel-heading font-bold bg-light dk">Product</header>
                <div class="panel-body">
                  <p>
                      <a href="form_product.php" class="btn btn-danger pjax-content-link"><i class="fa fa-plus"></i> &nbsp;New</a>
                  </p>
                    <form id="DataTables_List_company_Form">
                      <div class="table-responsive">
                        <table width="100%" class="table table-striped m-b-none dataTable no-footer" data-ride="datatables" id="DataTables_List_company">
                            <thead class="table-dark">
                                <tr role="row">
                                    <th>Product</th>
                                    <th>Company</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            if($row > 0){
                                while ($data = mysqli_fetch_assoc($query)) {
                                    echo    "<tr>
                                                <td>".$data['product']."</td>
                                                <td>".$data['company']."</td>
                                                <td>".$data['category']."</td>
                                                <td>".$data['description']."</td>
                                                <td>".$data['price']."</td>
                                                <td><a href='form_update_product.php?id=".$data['product_id']."& product=".$data['product']."& category_id=".$data['category_id']."&company_id=".$data['company_id']."&description=".$data['description']."&price=".$data['price']."' class='btn-primary btn-sm pjax-content-link' title='Edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                                    <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='delete_product.php?id=".$data['product_id']."' class='btn-danger btn-sm' title='Remove'><i class='fa fa-trash' aria-hidden='true'></i></a></td>
                                            </tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                      </div>
                    </form>
                </div>
              </section>
            </div>
<?php 
if (!isset($_SERVER["HTTP_X_PJAX"]) )
{
   include 'foot.php'; 
}
?>
