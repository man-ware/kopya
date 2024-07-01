<?php  
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table']= 'suppliers';
    $suppliers = include('database/show.php');

?>



<!DOCTYPE html>
<html>
    <head>
        <title>View Suppliers</title>
        <?php include('partials/app-header-scripts.php'); ?>
    </head>
    <body>
        <div id="dashboardMainContainer">

           <?php include('partials/app-sidebar.php') ?>

           <div class="dashboard_content_container" id="dashboard_content_container">
                    <?php include('partials/app-topnav.php') ?>
                <div class="dashboard_content">
                    <div class="dashboard_content_main">
                        <div class="row">
                            
                            <div class="column column-12">
                                <h1 class="section_header"><i class="fa-solid fa-list"></i> List of Suppliers</h1>
                                <div class="users">
                                    
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Supplier Name</th>
                                                <th>Supplier Location</th>
                                                <th>Description</th>
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($suppliers as $index => $supplier){ ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td>
                                                        <?= $supplier['supplier_name'] ?>
                                                    </td>
                                                    <td><?= $supplier['supplier_location'] ?> ?></td>
                                                    <td><?= $supplier['email'] ?></td>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <p class="userCount"><?= count($products) ?> Products </p>
                                </div>
                            </div>
                            </div>
                        </div>                                
                    </div>
            </div>
        </div>

        <?php include('partials/app-scripts.php'); ?>
    
    <script>
        function script (){
            this.registerEvents = function(){
                document.addEventListener('click', function(e){
                targetElement = e.target;
                classList = targetElement.classList;

                if(classList.contains('deleteProduct')){
                    e.preventDefault();
                    
                    pId = targetElement.dataset.pid;
                    pName = targetElement.dataset.name;
                    
                    BootstrapDialog.confirm({
                            type: BootstrapDialog.TYPE_DANGER,
                            title: 'Delete Product', 
                            message: 'Are you sure you want to delete <strong>' + pName + '</strong>?',
                            callback: function(isDelete){

                                if(isDelete){
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            id: pId,
                                            table: 'products'
                                        },
                                        url: 'database/delete.php',
                                        dataType: 'json',
                                        success: function(data){
                                            message = data.success ?
                                            pName + ' successfully deleted' : 'Error processing your request';

                                            
                                            BootstrapDialog.alert({
                                                    type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                                                    message: message,
                                                    callback: function(){
                                                        if (data.success) location.reload();
                                                    }
                                                });
                                            
                                            }       
            
                                    });
                                } 
                            }
                        });
                }
                  
            });
        }

            this.initialize = function (){
                this.registerEvents();
            }
        }

        var script = new script;
        script.initialize();

    </script>

    </body>
</html>


tangina