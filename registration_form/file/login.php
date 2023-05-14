<?php
ini_set("display_errors", 1);
// require_once "database.php";
require_once "config.php";
// if (!isset($db)) {
//     require_once "config.php";
// }
$Database = new Data();
$db = $Database->getConnection();

class User {
    public $db;
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

                if (!empty($_POST['remember'])) {
                    setcookie("username", $row['username'], time() + (86400 * 30), "/");
                    setcookie("password", $this->password, time() + (86400 * 30), "/");
                } else {
                    setcookie("username", "", time() - 3600);
                    setcookie("password", "", time() - 3600);
                }
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

if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $username = $_COOKIE["username"];
    $password = $_COOKIE["password"];
} else {
    $username = "";
    $password = "";
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if(empty($username) || empty($password))
    {
        $error = "Please enter username + password";
    }
    else{
        $user = new User($db, $username, $password);
        if ($user->authenticate()) {
            header("location: welcome.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    }
}

$db->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if (isset($error)): ?>
    <p>Error: <?php echo $error; ?></p>
<?php endif; ?>
<form method="post">
    <label for="username">Username</label>
    <input type="text" name="username" required>

    <label for="password">Password</label>
    <input type="password" name="password" required>

    <input type="submit" value="Login">
</form>

