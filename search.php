<?php

  session_start();

  require_once('Database.php');
  require_once('Record.php');

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json");
  
  $data = json_decode(file_get_contents("php://input"), true);
  
  if(isset($data['searchInput'])){
    $searchInput = $data['searchInput'];
    // $searchInput = 'medellin';

    $api_key = apache_getenv('WEATHER_API_KEY');
    
    $location_api = "https://api.openweathermap.org/geo/1.0/direct?q=".$searchInput."&limit=5&appid=".$api_key;
    $location_response = file_get_contents($location_api);
    $location_data = json_decode($location_response, true);
    $location_lat = $location_data[0]['lat'];
    $location_lon = $location_data[0]['lon'];
    
    $weather_api = "https://api.openweathermap.org/data/2.5/weather?lat=".$location_lat."&lon=".$location_lon."&appid=".$api_key."&units=metric";
    $weather_response = file_get_contents($weather_api);
    
    $weather_data = json_decode($weather_response, true);

    $db = new Database();
    $repo = new DBRecordRepository($db);
    
    $email = $db->escapeString($_SESSION['email']);
    // $email = 'admin@admin.com';
    $query = "SELECT user_id FROM users WHERE email = '$email';";
    $result = $db->select($query);
    $user_id = $result[0]['user_id'];
    
    $city = $weather_data['name'];
    $temperature = $weather_data['main']['temp'];
    $weather_description = $weather_data['weather'][0]['main'];
    
    $record = new Record($user_id,$city, $temperature, $weather_description);
    $repo->addRecord($record);
    
    if(json_last_error() !== JSON_ERROR_NONE){
      echo json_encode(['error' => json_last_error_msg()]);
      exit;
    }
    
    echo json_encode(['result' => $weather_data]);
  }
?>