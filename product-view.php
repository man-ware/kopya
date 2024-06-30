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
                                                    <td><?= $product['created_by'] ?></td>
                                                    <td><?= date('M d,Y @ h:i:s A', strtotime($product['created_at'])) ?></td>
                                                    <td><?= date('M d,Y @ h:i:s A', strtotime($product['updated_at'])) ?></td>
                                                    <td>
                                                        <a href="" class="updateUser" data-userid="<?= $product['id']?>"><i class="fa fa-pencil" ></i>Edit</a>
                                                        <a href="" class="deleteUser" data-userid="<?= $product['id']?>"><i class="fa fa-trash"></i>Delete</a>
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
    </script>

    </body>
</html>


tangina