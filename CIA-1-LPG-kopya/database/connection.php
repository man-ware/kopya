<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    // connecting pa database
    try {
        $conn = new PDO("mysql:host=$servername;dbname=inventory", $username, $password);
        //PDO set error mode
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (\Exception $e){
        $error_message =$e->getMessage();
    }


?>