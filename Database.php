<?php
class Database{
  private $host;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  public function __construct(){
    $this->host = apache_getenv('DB_HOST');
    $this->username = apache_getenv('DB_USERNAME');
    $this->password = apache_getenv('DB_PASSWORD');
    $this->dbname = apache_getenv('DB_NAME');
    $this->connect();
  }

  private function connect(){
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

    if($this->conn->connect_error){
      die("Connection Failed:". $this->conn->connect_error);
    }
  }

  public function select($sql){
    $result = $this->conn->query($sql);
    if($result->num_rows > 0){
      return $result->fetch_all(MYSQLI_ASSOC);
    } else{
      return [];
    }
  }

  public function execute($sql){
    if($this->conn->query($sql) === TRUE){
      return true;
    } else{
      return "Error". $this->conn->error;
    }
  }

  public function escapeString($valor){
    return $this->conn->real_escape_string($valor);
  }

  public function close(){
    $this->conn->close();
  }
}
?>