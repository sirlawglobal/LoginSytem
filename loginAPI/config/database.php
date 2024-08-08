<?php 
session_start();

  class Database{

    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "school_portal_db";

    public $connect;

    public function __construct(){
        $this->connect = new mysqli($this->host, $this->username, $this->password, $this->database);
        ;
        if($this->connect->connect_errno){
            echo "failed to connect to database";
        }
    }

    
 
    public function saveData($data){
    

        $userName = $data['userName'];
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $password = $data['password'];
         $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $email = $data['email'];

      
          $sql = "INSERT INTO users (first_name, last_name, username, email, password) VALUES('{$firstName}', '{$lastName}','{$userName}', '{$email}', '{$hashedPassword}')";

          $query = $this->connect->query($sql);
          return $query;
        }





    public function login($data){
      $username = $data['userName'];
      $password = $data['password'];
      $sql = "SELECT * FROM users WHERE username='$username'";
      $query = $this->connect->query($sql);
      $user = $query->fetch_assoc();
      if($user){
        $password_verify = password_verify($password, $user['password']);
        if($password_verify){
          $_SESSION['user'] = $user;
          $_SESSION['username'] = $user['username'];
          //example
          //$session_user_id = $_SESSION['user']['id'];
          return $user;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }

  

    public function logout(){
        if (isset($_SESSION['username']) && $_SESSION['username'] !== null) {
            session_unset();
            session_destroy();
            return true;
        } else {
          return false;
        }
      
    }

  }
    


?>