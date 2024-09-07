<?php
  class Record{
    public $id;
    public $user_id;
    public $city;
    public $temperature;
    public $weather_description;
    public $date;

    public function __construct($user_id, $city, $temperature, $weather_description){
      $this->user_id = $user_id;
      $this->city = $city;
      $this->temperature = $temperature;
      $this->weather_description =$weather_description;
    }
    public function setId($id){
      $this->id = $id;
    }
    public function setDate($date){
      $this->date = $date;
    }
  }

  abstract class RecordRepository{
    abstract public function addRecord($record);
    abstract public function getRecords($email);
  }

  class DBRecordRepository extends RecordRepository{
    public function __construct($database){
      $this->database = $database;
    }
    public function addRecord($record){
      $user_id = $record->user_id;
      $city = $this->database->escapeString($record->city);
      $temperature = $record->temperature;
      $description = $this->database->escapeString($record->weather_description);

      $sql = "INSERT INTO search_history(user_id, city, temperature, description) VALUES ($user_id, '$city', $temperature, '$description')";
       $id = $this->database->execute($sql);
       if($id > 0){
        $query = "SELECT created_at FROM search_history WHERE search_id=$id";
        $results = $this->database->select($query);
        $record->setId($id);
        $record->setDate($results[0]['created_at']);
       }
    }
    public function getRecords($email){
      $email = $this->database->escapeString($email);
      $query = "SELECT r.* FROM search_history as r WHERE r.user_id = (
        SELECT u.user_id FROM users AS u WHERE u.email = '$email'
      )";
      $result = $this->database->select($query);

      if(empty($result)){
        return;
      }
      
      $records = array_map(function($record){
        $new_record = new Record($record['user_id'], $record['city'], $record['temperature'], $record['description']);
        $new_record->setId($record['search_id']);
        $new_record->setDate($record['created_at']);

        return $new_record;
      },$result);
      return $records;
    }
  }
?>