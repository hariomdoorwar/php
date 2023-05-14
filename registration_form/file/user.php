<?php
ini_set("display_errors", 1);
session_start();
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $password) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password, $remember = false) {
        $stmt = $this->db->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Set session variables
                $_SESSION["username"] = $row['username'];
                $_SESSION["id"] = $row['id'];
                $_SESSION["loggedin"] = true;

                // Set cookie if remember me is checked
                if ($remember) {
                    $token = bin2hex(random_bytes(32));
                    setcookie('remember_token', $token, time()+60*60*24*30, '/');
                    $stmt = $this->db->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                    $stmt->bind_param("si", $token, $row['id']);
                    $stmt->execute();
                }

                return true;
            }
        }

        return false;
    }

    public function logout() {
        // Unset session variables
        unset($_SESSION["username"]);
        unset($_SESSION["id"]);
        unset($_SESSION["loggedin"]);

        // Delete remember me cookie
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time()-3600, '/');
            $stmt = $this->db->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
            $stmt->bind_param("i", $_SESSION["id"]);
            $stmt->execute();
        }
    }
}
?>
