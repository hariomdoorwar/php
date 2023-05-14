<?php
ini_set("display_errors", 1);
// session_start();

class MyDB {
    private $conn;
    
    public function __construct($host, $username, $password, $database) {

        $this->conn = mysqli_connect($host, $username, $password, $database);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    
    public function executeQuery($sql, $params) {
        $stmt = mysqli_prepare($this->conn, $sql);
        if ($params) {
            mysqli_stmt_bind_param($stmt, ...$params);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return $result;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        mysqli_close($this->conn);
    }
}

$db = new MyDB("localhost", "root", "", "login");

$conn = $db->getConnection();
?>
