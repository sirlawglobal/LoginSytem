<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);
    
    require('./config/Database.php');

    $db = new Database();
    
    if(isset($_GET['function'])){

        $function = $_GET['function'];

        //register
        if($function == 'save-data'){

            $user = $db->saveData($_POST);

            if($user){
                echo json_encode(['success'=>"Data saved successfully!"]);
            }else{
              echo json_encode(['error'=>"Please try another email address"]);
            }
        }
        //login
        if($function == 'login'){
            $user = $db->login($_POST);
            if($user){
                echo json_encode(['success'=>"logged in", "user"=>$user]);
            }else{
              echo json_encode(['error'=>"Wrong username or password"]);
            }
        }
        //logout
        if($function == 'logout'){
            $user = $db->logout();
            if($user){
                echo json_encode(['success'=>"logged out"]);
            }else{
              echo json_encode(['error'=>"logout failed"]);
            }
        }

      
    }



?>