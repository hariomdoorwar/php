<?php
class Signup {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUser() {
        $showAlert = false;
        $showError = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];
            $exists = false;

            if (($password == $cpassword) && $exists == false) {
                $sql = "INSERT INTO `Users` ( `Username`, `Password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
                $result = mysqli_query($this->conn, $sql);
                if ($result) {
                    $showAlert = true;
                }
            } else {
                $showError = "Passwords do not match";
            }

            header("location: login.php");
        }

        echo '
        <div class="container my-4">
            <h1 class="text-center">Signup to our website</h1>
            <form action="signup.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">

                    <label for="confirm password">confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword">
                </div>
                <button type="submit" class="btn btn-primary">Signup</button>
            </form>
        </div>';

        if ($showAlert) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You are logged in
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        }

        if ($showError) {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $showError . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        }
    }
}

include '_dbconnect.php';
$signup = new Signup($conn);
$signup->createUser();

include '_nav.php';
?>
