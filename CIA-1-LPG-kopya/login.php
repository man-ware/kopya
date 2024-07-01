<?php 
    session_start();
    if(isset($_SESSION{'user'})) header('location: dashboard.php');

     $error_message = '';

    if($_POST){
        include('database/connection.php');

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = 'SELECT * FROM users WHERE users.email="'. $username .'" AND users.password="'. $password .'" LIMIT 1';
        $stmt = $conn->prepare($query);
        $stmt->execute();

    
        if($stmt->rowCount() >0){
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetchAll()[0];

            //
            $_SESSION['user'] = $user;

             header('Location: dashboard.php');
            
        } else $error_message = 'Please make sure that username and password are correct.';

    }    

?>

<!DOCTYPE html>
<html>
    <head>
        <title>IMS Login - Inventory Management System</title>

        <link rel="stylesheet" type="text/css" href="css/login.css?v=<?= time() ?>">

    </head>
    <body id="loginBody">
        <?php if(!empty($error_message)) { ?>
            <div id="errorMessage"> 
                <strong>Error: </strong>  </p> <?= $error_message ?></p>
            </div>
        <?php } ?>
        <div class="container">
            <div>
                <div class="loginHeader">
                    <h1>IMS</h1>
                    <h3>
                        Inventory Management System</h3>

                </div>

                <div class="loginBody">
                    <form action="login.php" method="POST">
                        <div class="loginInputContainer">
                            <label for="">Username</label>
                            <input placeholder="username" name="username" type="text"/>
                        </div>
                        <div class="loginInputContainer">
                            <label for="">Password</label>
                            <input placeholder="password" name="password" type="password"/>
                        </div>
                        <div class="loginButtonContainer">
                            <button>login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </body>
</html>