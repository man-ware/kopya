<?php 
        session_start();

        include('table_colunms.php'); 

        $table_name = $_SESSION['table'];
        $columns = $table_columns_mapping [$table_name];

        $db_arr = [];
        $user = $_SESSION['user'];
        foreach($columns as $column){
            if(in_array($column, ['created_at', 'updated_at'])) $value = date('Y-m-d H:i:s');
            else if ($column == 'created_by') $value = $user['id'];

            else if ($column == 'img'){

                $target_dir = "../database/upload/";
                $file_data = $_FILES[$column];

                $file_name = $file_data ['name'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_name = 'product-' . time() . '.' . $file_ext;
                $check = getimagesize($file_data['tmp_name']);

               if($check) {
                if(move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)){
                    $value = $file_name;



               }
              }  else {

               }
            }
            else $value = isset($_POST[$column]) ? $_POST[$column] : '';

           


            $db_arr[$column] = $value;
        }
       
        $table_properties = implode(", ", array_keys($db_arr));
        $table_placeholders =  ':' . implode(", :", array_keys($db_arr));

        //Users Data
        //$first_name = $_POST['first_name'];
        //$last_name = $_POST['last_name'];
        //$email = $_POST['email'];
        //$password = $_POST['password'];
    
        //$encrypted = password_hash($password, PASSWORD_DEFAULT);

//adding record
    try{

    $sql = "INSERT INTO 
                            $table_name($table_properties) 
                        VALUES 
                            ($table_placeholders)";


    include('connection.php');

    $stmt= $conn->prepare($sql);
    $stmt->execute($db_arr);

    $response = [
        'success' => true,
        'message' => ' Successfully added to the system.'
        ];
   
    } catch (PDOException $e){        
    $response = [
        'success' => false,
        'message' => $e->getMessage()
        ];
    }

    $_SESSION['response'] = $response;
    header('location: ../' . $_SESSION['redirect_to']);
        
?>