<?php
  require_once('Database.php');

  $db = new Database();

  session_start();

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if($password !== $password2){
      echo "Las contraseñas no coinciden";
      exit();
    }
    $name = $db->escapeString($name);
    $email = $db->escapeString($email);
    $password = password_hash($db->escapeString($password), PASSWORD_DEFAULT);

    $create_user_query = "INSERT INTO users(name, email) VALUES('$name', '$email')";
    $user_id = $db->execute($create_user_query);
    if($user_id){
      $create_auth_query = "INSERT INTO auth_users(user_id, email, password) VALUES ($user_id, '$email', '$password')";
      if($db->execute($create_auth_query)){
        $_SESSION["email"] = $email;
        header("Location: index.php");
      } else{
        echo "Error al crear la autenticación del usuario";
      }
    } else{
      echo "Error al crear al usuario";
    }

  }
?>