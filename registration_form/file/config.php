<?php
ini_set("display_errors", 1);
session_start();

class Data {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "login";
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->dbName);

        if(!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
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
        mysqli_close($this->conn);
    }

   
}
$db = new Data();
$conn = $db->getConnection();
?>



