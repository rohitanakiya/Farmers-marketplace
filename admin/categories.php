<?php if (!isset($_SERVER["HTTP_X_PJAX"])) {   ?>
</head>
<body class="">
<?php include 'block.head.php'; ?>
<?php } ?>
    <script type="application/javascript">
    $('document').ready(function(){
        $('#DataTables_List_categories').DataTable({
            "bProcessing": true,
            "bSortable": false,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "processing": true,
            "stateSave": true,
        }); 
    });  
    </script>
        <?PHP
        include_once 'config/database.php';

        $sql="select category ,id,category_image from categories WHERE deleted != 1";
        
        $query=mysqli_query($conn,$sql);
        $row=mysqli_num_rows($query);
            ?>
            <div class="wrapper">
              <section class="panel panel-default" style="margin-top: 10px;">
                <header class="panel-heading font-bold bg-light dk">Categories</header>
                  <div class="panel-body">
                    <p>
                        <a href="form_category.php" class="btn btn-danger pjax-content-link"><i class="fa fa-plus"></i> &nbsp;New</a>
                    </p>
                     <form >
                        <div class="table-responsive">
                          <table width="100%" class="table table-striped m-b-none dataTable no-footer" data-ride="datatables" id="DataTables_List_categories">
                            <thead class="table-dark">
                                <tr role="row">
                                    <th>category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php   
                            if($row > 0)
                            {
                                while ($data = mysqli_fetch_assoc($query)) {
                                    echo    "<tr>
                                                <td>".$data['category']."</td>
                                                <td><a href='form_update_category.php?id=".$data['id']."& category=".$data['category']."&category_image=".$data['category_image']."' class='btn-primary btn-sm pjax-content-link' title='Edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                                    <a href='delete_categories.php?id=".$data['id']."' class='btn-danger btn-sm' title='Remove' onClick=\"javascript: return confirm('Please confirm deletion');\"><i class='fa fa-trash' aria-hidden='true'></i></a></td>
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
