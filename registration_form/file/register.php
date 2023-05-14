<?php
ini_set("display_errors", 1);
session_start();

class Database {
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

    public function closeConnection() {
        mysqli_close($this->conn);
    }
}

class User {
    private $db;
    private $username;
    private $password;
    private $confirmPassword;

    public function __construct($db, $username, $password, $confirmPassword) {
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function register() {
        if ($this->password !== $this->confirmPassword) {
            return "Passwords do not match";
        }

        $existingUserQuery = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->db->getConnection(), $existingUserQuery);
        mysqli_stmt_bind_param($stmt, 's', $this->username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            return "Username already exists";
        }

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $registerQuery = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->db->getConnection(), $registerQuery);
        mysqli_stmt_bind_param($stmt, 'ss', $this->username, $hashedPassword);
        mysqli_stmt_execute($stmt);

        if (mysqli_affected_rows($this->db->getConnection()) > 0) {
            $_SESSION['username'] = $this->username;
            $_SESSION['loggedin'] = true;

            // Set a cookie to remember the user for 7 days
            setcookie('remember', $this->username, time() + (86400 * 7), "/");

            return true;
        }

        return "Registration failed";
    }
}

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    $user = new User($db, $username, $password, $confirmPassword);
    $registrationResult = $user->register();

    if ($registrationResult === true) {
        header("Location: welcome.php");
        exit;
    } else {
        $error = $registrationResult;
    }
}

$db->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($error)): ?>
        <p>Error: <?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required>

        <label for="email">Email</label>
<input type="email" name="email" required>

<label for="password">Password</label>
<input type="password" name="password" required>

<label for="confirm_password">Confirm Password</label>
<input type="password" name="confirm_password" required>

<button type="submit">Register</button>
</body>
</html>
