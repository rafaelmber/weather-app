<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json");

  $data = json_decode(file_get_contents("php://input"), true);

  if(isset($data['searchInput'])){
    $searchInput = $data['searchInput'];
    $api_key = apache_getenv('WEATHER_API');

    $api_url = "https://api.openweathermap.org/geo/1.0/direct?q=".$searchInput."&limit=5&appid=".$api_key;
    $api_response = file_get_contents($api_url);

    $api_data = json_decode($api_response, true);

    echo json_encode(['result' => $api_data['result']]);

    if (json_last_error() !== JSON_ERROR_NONE) {
      echo json_last_error_msg();
    } else {
      echo $response;
    }

  } else{
    echo json_encode(['Error' =>"Fail to send text"]);
  }

?>