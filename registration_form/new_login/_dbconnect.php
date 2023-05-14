<?php
class Database {
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "login";
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->server, $this->username, $this->password, $this->database);
        if (!$this->conn) {
            die("Error: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function __destruct() {
        mysqli_close($this->conn);
    }
}

$db = new Database();
$conn = $db->getConnection();
?>