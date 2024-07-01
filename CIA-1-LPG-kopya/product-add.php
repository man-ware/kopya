<?php  
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    $_SESSION['table']= 'products';
    $_SESSION['redirect_to']= 'product-add.php';
    $user = $_SESSION['user'];
  

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Add Product</title>

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
                                <h1 class="section_header"><i class="fa-solid fa-plus"></i> Create Create</h1>
                                    <div id="userAddFormContainer">
                                        <form action="database/add.php" method="POST" class="appForm">
                                            <div class="appFormInputContainer">
                                                <label for="product_name"> Product Name</label>
                                                <input type="text" class="appFormInput" id="product_name" placeholder= "Enter product name..." name="product_name" />
                                            </div>
                                            <div class="appFormInputContainer">
                                                <label for="description">Description</label>
                                                <textarea class="appFormInput productTextAreaInput" placeholder="Enter product description..." id="description" name="description"></textarea>
                                            </div>
                                            <div class="appFormInputContainer">
                                                <label for="unit_price"> Price</label>
                                                <input type="text" class="appFormInput" id="unit_price" placeholder= "Enter product price..."name="unit_price" />
                                            </div>
                                            
                                            
                                                <button type="submit" class="appBtn"><i class="fa fa-plus"></i>Create Product</button>
                                        </form>
                                            <?php 
                                            
                                                if( isset ($_SESSION['response'])) {
                                                    $response_message = $_SESSION['response']['message'];
                                                    $is_success = $_SESSION['response']['success'];
                                            ?>
                                                    <div class="responseMessage">
                                                        <p class="<?= $is_success ? 'responseMessage__success' : 'responseMessage__error'?>">
                                                            <?=$response_message ?>
                                                        
                                                        </p>
                                                    </div>
                                                <?php unset($_SESSION['response']); } ?>
                                    </div>
                            </div>
                            
                            </div>
                        </div>                                
                    </div>
            </div>
        </div>
        <?php include('partials/app-scripts.php'); ?>
        
   

    </body>
</html>
