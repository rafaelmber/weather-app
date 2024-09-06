<?php
  require_once('Database.php');

  $db = new Database();

  session_start();

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']
    $password2 = $_POST['password2']

    

  }



?>