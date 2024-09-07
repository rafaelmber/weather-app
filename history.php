<?php
  require_once('Database.php');
  require_once('Record.php');

session_start();

  if(!isset($_SESSION['email'])){
    header('Location: login.php');
    exit();
  }

  $db = new Database();

  $repo = new DBRecordRepository($db);
  $records = $repo->getRecords($_SESSION['email']);
  $db->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="history.css">
  <title>History | Weather App</title>
</head>
<body>
    <?php
    include('header.php');
    ?>
      <main>

        <table>
          <thead>
            <tr>
              <th scope='col'>Ciudad</th>
              <th scope='col'>Temperatura</th>
              <th scope='col'>Descripcion</th>
              <th scope='col'>Fecha y hora</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(!empty($records)){
              foreach($records as $record){
                echo '<tr>';
                echo '<td>'.htmlspecialchars($record->city).'</td>';
                echo '<td>'.htmlspecialchars($record->temperature).'°C</td>';
                echo '<td>'.htmlspecialchars($record->weather_description).'</td>';
                echo '<td>'.htmlspecialchars($record->date).'</td>';
                echo '</tr>';
              }
            } else{
              echo '<tr>Aún no tienes busquedas en tu historial</tr>';
            }
        ?>
    </tbody>
  </table>
      </main>
    <?php
    include('footer.php');
    ?>
</body>
</html>