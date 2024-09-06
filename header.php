<!-- header.php -->
 <?php
//  session_start();
  $is_logged_in = false;
  if(isset($_SESSION['email'])){
    $is_logged_in = true;
  }
 ?>
<header class="header">
  <nav class="navbar">
    <h1 class="navbar__title"><a href="index.php">Weather App</a></h1>
    <?php if($is_logged_in):?>
    <span><a class='navbar__button' href='logout.php'>Log out</a></span>
    <?php endif; ?>
  </nav>
</header>
