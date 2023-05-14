<?php
//This script will handle login

ini_set("display_errors", 1);
session_start();


if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "configure.php";

$username = $password = "";
$err = "";


if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                           
                            header("location: welcome.php");
                            
                        }
                    }

                }

    }
}    


}


?>




<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
	<h2>Log In</h2>
	<form action="" method="POST">
		<label for="username">Username:</label>
		<input type="text" name="username" required>

		<label for="password">Password:</label>
		<input type="password" name="password" required>



		<button type="submit" name="login">Login</button>
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
