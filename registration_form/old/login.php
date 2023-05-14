<?php

ini_set("display_errors", 1);
session_start();

class Database {
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
}

class User {
    private $db;
    private $username;
    private $password;
    
    public function __construct($db, $username, $password) {
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function authenticate() {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $params = ['s', $this->username];
        $result = $this->db->executeQuery($sql, $params);
        
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($this->password, $row['password'])) {
                $_SESSION["username"] = $row['username'];
                $_SESSION["id"] = $row['id'];
                $_SESSION["loggedin"] = true;
                return true;
            }
        }
        
        return false;
    }
}

if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}

require_once "configure.php";

$db = new Database($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if(empty($username) || empty($password))
    {
        $err = "Please enter username + password";
    }
    else{
        $user = new User($db, $username, $password);
        if ($user->authenticate()) {
            header("location: welcome.php");
            exit;
        } else {
            $err = "Invalid username or password";
        }
    }
}

?>
