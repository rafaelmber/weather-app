<?php
  require_once 'Database.php';

  $db = new Database();

  session_start();


  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = $db->escapeString($email);
    $password = $db->escapeString($password);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM auth_users WHERE email='$email' and '$password'";

    $result = $db->select($query);

    if(count($result) > 0){
      $_SESSION['email'] = $email;
      header('Location: index.php');
    } else{
      echo "Invalid username or password, please try again";
    }
  }
  $db->close();
?>