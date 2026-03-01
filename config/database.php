<?php
class Database
{
  private $host = "localhost";
  private $db_name = "kampus";
  private $username = "root";
  private $password = "";
  private $port = "3307"; // Tambahkan properti port
  public $conn;

  public function getConnection()
  {
    $this->conn = null;
    try {
      // Tambahkan ;port= ke dalam string koneksi
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" .
        $this->db_name . ";port=" . $this->port, $this->username, $this->password); 
      
      $this->conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
      ); 
    } catch (PDOException $exception) {
      echo "Koneksi Gagal: " . $exception->getMessage(); 
    }
    return $this->conn; 
  }
}
?>