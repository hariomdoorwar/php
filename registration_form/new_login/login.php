<?php

session_start();

class User {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function login() {
        include '_dbconnect.php';
        $sql = "SELECT * FROM Users WHERE username='$this->username' AND password='$this->password'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            // Set the cookie named "user" with the username as its value
            setcookie("user", $this->username, time()+300, "/");
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $this->username;
            header("location: welcome.php");
            exit();
        } else {
            $_SESSION['loggedin'] = false;
            $error = "Invalid Credentials";
            return $error;
        }
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = new User($username, $password);
    $error = $user->login();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <?php require '_nav.php' ?>
    <div class="container">
      <h1>Login</h1>
      <form action="login.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <?php
        if(isset($error) && $error!=''){
            echo $error."<br>";
        }
        ?>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js