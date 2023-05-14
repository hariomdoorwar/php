<?php

require_once "configure.php";

class User
{
    private $conn;
    private $username;
    private $password;
    private $confirmPassword;
    private $usernameErr;
    private $passwordErr;
    private $confirmPasswordErr;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->username = $this->password = $this->confirmPassword = "";
        $this->usernameErr = $this->passwordErr = $this->confirmPasswordErr = "";
    }

    public function setUsername($username)
    {
        $this->username = trim($username);
    }

    public function setPassword($password)
    {
        $this->password = trim($password);
    }

    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = trim($confirmPassword);
    }

    public function getUsernameErr()
    {
        return $this->usernameErr;
    }

    public function getPasswordErr()
    {
        return $this->passwordErr;
    }

    public function getConfirmPasswordErr()
    {
        return $this->confirmPasswordErr;
    }

    public function validate()
    {
        // Check if username is empty
        if (empty($this->username)) {
            $this->usernameErr = "Username cannot be blank";
        } else {
            $stmt = mysqli_prepare($this->conn, "SELECT id FROM users WHERE username = ?");
            mysqli_stmt_bind_param($stmt, "s", $this->username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                $this->usernameErr = "This username is already taken";
            }
            mysqli_stmt_close($stmt);
        }

        // Check for password
        if (empty($this->password)) {
            $this->passwordErr = "Password cannot be blank";
        } elseif (strlen($this->password) < 5) {
            $this->passwordErr = "Password cannot be less than 5 characters";
        }

        // Check for confirm password field
        if ($this->password !== $this->confirmPassword) {
            $this->confirmPasswordErr = "Passwords should match";
        }

        return empty($this->usernameErr) && empty($this->passwordErr) && empty($this->confirmPasswordErr);
    }

    public function register()
    {
        $stmt = mysqli_prepare($this->conn, "INSERT INTO users (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $this->username, password_hash($this->password, PASSWORD_DEFAULT));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = new User($conn);
    $user->setUsername($_POST["username"]);
    $user->setPassword($_POST["password"]);
    $user->setConfirmPassword($_POST["confirm_password"]);

    if ($user->validate()) {
        $user->register();
        header("location: login.php");
        exit;
    }
}

mysqli_close($conn);

?>





<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
</head>
<body>
	<h2>Registration Form</h2>
	<form action="" method="post">
		<label for="username">Username:</label>
		<input type="text" name="username" required>

		<label for="password">Password:</label>
		<input type="password" name="password" required>

		<label for="confirm_password">Confirm Password:</label>
		<input type="password" name="confirm_password" required>

		<button type="submit" name="register">Register</button>
	</form>
</body>

<style>
    form {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

label {
  font-size: 1.2rem;
  margin-bottom: 10px;
}

input[type="text"],
input[type="password"] {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 20px;
  font-size: 1.2rem;
  width: 100%;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 5px;
  font-size: 1.2rem;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}

</style>

</html>
