<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false)
{
    header("location: login.php");
    exit();
}

class Page {
  private $username;

  public function __construct() {
    if (isset($_POST['username'])) {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['last_activity'] = time();
    }
    $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
  }

  public function renderHeader() {
    $this->checksessiontimeout();
    echo '<!doctype html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
    echo '<title>Welcome - ' . $this->username . '</title>';
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
    echo '<style>';
    echo 'body { background-color: #f0f0f0; }';
    echo 'h1 { text-align:center; color:black; }';
    echo '</style>';
    echo '</head>';
    echo '<body>';
    require '_nav.php';
    echo '<h1>Welcome - ' . $this->username . '</h1>';

    // Check if the session has expired
    
  }

    public function checksessiontimeout(){
        $session_expiration = 30; // 30 seconds.
        if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_expiration)) {
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit;
        } else {
        $_SESSION['last_activity'] = time(); // Update last activity time
        }
    }

  public function renderFooter() {
    $str = '';
    $str = '<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>';
    $str .= '<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>';
    echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>';
    $str .= '</body>';
    $str .= '</html>';
    return $str;
  }
}

$page = new Page();
$page->renderHeader();
echo $page->renderFooter();
?>