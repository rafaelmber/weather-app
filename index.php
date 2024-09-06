<?php
  session_start();

  if(!isset($_SESSION['email'])){
    header('Location: login.php');
    exit();
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="header.css">
    <title>Weather App</title>
  </head>
  <body>
    <?php
      include('header.php');
    ?>
    <main>
      <form id='search-form' class="weather-search">
        <label for="search-text">Ciudad</label>
        <input id='search-text'type="text" name="search-text" class="weather-search__text" />
        <input type="submit" value="Search" class="weather-search__btn" />
      </form>
      <section class="current-weather">
        <img class="current-weather__icon" src="https://openweathermap.org/img/wn/10d@2x.png" />
        <h2 class="current-weather__location">Cali</h2>
        <div class="current-weather__temp">
          <h3 class="current-weather__temp__current-temp">28° C</h3>
          <small class="current-weather__temp">22° | 35°. Sensación térmica: 40°</small>
        </div>
      </section>
      <section><a href='logout.php'>Log out</a></section>
    </main>
    <?php
      include('footer.php');
    ?>
    <script src='./index.js'></script>
  </body>
</html>
