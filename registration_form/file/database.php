<?php
ini_set("display_errors", 1);
session_start();
class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($host, $username, $password, $database);

        if($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function executeQuery($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        echo("hello");
        if ($stmt === false) {
            die("Error in statement preparation: " . $this->conn->error);
        }
        echo("hello1 ");
        if (!empty($params)) {
            $stmt->bind_param(...$params);
            echo("hello2 ");
        }
        echo("hello3 ");
        $stmt->execute();
        $result = $stmt->get_result();
        echo("hello4 ");
        return $result;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

?>
