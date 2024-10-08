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
    <title>Weather App</title>
  </head>
  <body>
    <?php
      include('header.php');
    ?>
    <main>
      <form id='search-form' class="weather-search" method='POST'>
        <label for="search-text">Ciudad</label>
        <input id='search-text'type="text" name="search-text" class="weather-search__text" />
        <input type="submit" value="Search" class="weather-search__btn" />
      </form>
      <section class="current-weather">
        <img class="current-weather__icon" src="https://openweathermap.org/img/wn/10d@2x.png" id='current-weather__icon'/>
        <div>
          <h2 class="current-weather__location" id='current_weather__location'>Cali</h2>
          <p class='current-weather__description' id="current-weather__description">Soleado</p>
        </div>
        <div class="current-weather__temp">
          <h3 class="current-weather__temp__current-temp" id='current_weather__temperature'>28° C</h3>
          <small class="current-weather__temp" id='current_weather__more_temp'>22° | 35°. Sensación térmica: 40°</small>
        </div>
      </section>
      <a class='history-button' href='history.php'>Historial de búsquedas</a>
    </main>
    <?php
      include('footer.php');
    ?>
    <script src='./index.js'></script>
  </body>
</html>
