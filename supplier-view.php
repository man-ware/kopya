<?php  
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table']= 'products';
    $products = include('database/show.php');

?>



<!DOCTYPE html>
<html>
    <head>
        <title>View Products</title>
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
                                <h1 class="section_header"><i class="fa-solid fa-list"></i> List of Products</h1>
                                <div class="users">
                                    
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Images</th>
                                                <th>Product Name</th>
                                                <th>Description</th>
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($products as $index => $product){ ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td class="firstName">
                                                        <img class ="productImages" src= "database/upload/<?= $product['img']?>" alt="" />

                                                    </td>
                                                    <td class="lastName"><?= $product['product_name'] ?></td>
                                                    <td class="email"><?= $product['description'] ?></td>
                                                    <td>
                                                        <?php 
                                                            $pid = $product['created_by'];
                                                            $stmt = $conn->prepare("SELECT * FROM users WHERE id=$pid");
                                                            $stmt->execute();
                                                            $row =  $stmt->fetch(PDO::FETCH_ASSOC);

                                                            $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
                                                            echo $created_by_name;
                                                        ?>

                                                    </td>

                                                    <td><?= date('M d,Y @ h:i:s A', strtotime($product['created_at'])) ?></td>
                                                    <td><?= date('M d,Y @ h:i:s A', strtotime($product['updated_at'])) ?></td>
                                                    <td>
                                                        <a href="" class="updateProduct" data-pid="<?= $product['id'] ?> " data-pid="<?= $product['id']?>"><i class="fa fa-pencil" ></i>Edit</a> |
                                                        <a href="" class="deleteProduct" data-name = "<?= $product['product_name'] ?>" data-pid="<?= $product['id']?>"><i class="fa fa-trash"></i>Delete</a>
                                                    </td>
                                                </tr>
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