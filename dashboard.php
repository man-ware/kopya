<?php  
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - Inventory Management System</title>
        <link rel="stylesheet" type="text/css" href="css/login.css?v=<?= time() ?>">
        <script src="https://kit.fontawesome.com/39390442f3.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="dashboardMainContainer">
                  <?php include('partials/app-sidebar.php') ?>

            <div class="dashboard_content_container" id="dashboard_content_container">
                  <?php include('partials/app-topnav.php') ?>

                <div class="dashboard_content">
                    <div class="dashboard_content_main">

                    </div>
                </div>
            </div>
        </div>

    
         <script src="js/script.js"> </script>
        
    </body>
</html>