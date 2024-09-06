<?php
  session_start();
  if(isset($_SESSION['email'])){
    header('Location: index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="login.css">
  <title>Sign Up | Weather App</title>
</head>
<body>
  <?php
    include('header.php')
  ?>
  <main>
    <form class='login-form' method='POST' action='new_user_auth.php'>
      <h2 class='login-form__title'>Sign up</h2>
      <label for='name'>Name</label>
      <input type='text' id='name' name='name' class='login-form__input' required/>
      <label for='email'>Email</label>
      <input type='email' id='email' name='email' class='login-form__input' required/>
      <label for='password'>Password</label>
      <input type='password' id='password' name='password' class='login-form__input' required/>
      <label for='password2'>Re-entry the Password</label>
      <input type='password' id='password2' name='password2' class='login-form__input' required/>
      <input type='submit' value='Log in' class='login-form__btn'/>
      <p>Have an account? Log in <a href="login.php" class='login-form__signup'>here</a></p>
    </form>
  </main>
  <?php
    include('footer.php');
  ?>
</body>
</html>