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

        $sql="select company,company_id,email,address,website,contact_number,description,company_logo,state,city from company WHERE deleted != 1";
        $query=mysqli_query($conn,$sql);
        $row=mysqli_num_rows($query);
        ?>
            <div class="wrapper">
              <section class="panel panel-default" style="margin-top: 10px;">
              <header class="panel-heading font-bold bg-light dk">Company</header>
                <div class="panel-body">
                  <p>
                      <a href="form_company.php" class="btn btn-danger pjax-content-link"><i class="fa fa-plus"></i> &nbsp;New</a>
                  </p>
                    <form id="DataTables_List_company_Form">
                      <div class="table-responsive">
                        <table width="100%" class="table table-striped m-b-none dataTable no-footer" data-ride="datatables" id="DataTables_List_company">
                            <thead class="table-dark">
                                <tr role="row">
                                    <th>company</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Webside</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            if($row > 0){
                                while ($data = mysqli_fetch_assoc($query)) {
                                    echo    "<tr>
                                                <td>".$data['company']."</td>
                                                <td>".$data['email']."</td>
                                                <td>".$data['address']."</td>
                                                <td>".$data['website']."</td>
                                                <td><a href='form_update_company.php?id=".$data['company_id']."& company=".$data['company']."& email=".$data['email']."& address=". $data['address']."& contact_number=".$data['contact_number']."& website=".$data['website']."& company_logo=".$data['company_logo']."& state=".$data['state']."& city=".$data['city']."& description=".$data['description']."' class='btn-primary btn-sm pjax-content-link' title='Edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                                                    <a onClick=\"javascript: return confirm('Please confirm deletion');\" href='delete_company.php?id=".$data['company_id']."' class='btn-danger btn-sm' title='Remove'><i class='fa fa-trash' aria-hidden='true'></i></a></td>
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
