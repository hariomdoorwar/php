<?php
class Navbar {
    //private $brandName;
    private $navItems = [];
    private $loggedIn = false;

    public function __construct($brandName) {
        $this->brandName = $brandName;
    }

    public function addNavItem($label, $url, $isActive = false) {
        $this->navItems[] = ['label' => $label, 'url' => $url, 'isActive' => $isActive];
    }

    public function setLoggedIn($loggedIn) {
        $this->loggedIn = $loggedIn;
    }

    public function render() {
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/training_php"><?php echo $this->brandName; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php foreach ($this->navItems as $navItem): ?>
                        <li class="nav-item <?php echo $navItem['isActive'] ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo $navItem['url']; ?>"><?php echo $navItem['label']; ?><?php echo $navItem['isActive'] ? '<span class="sr-only">(current)</span>' : ''; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if (!$this->loggedIn): ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Signup</a>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </nav>
        <?php
    }
}

// Example usage:
$navbar = new Navbar('Login System');
$navbar->addNavItem('Home', 'welcome.php', true);
$navbar->setLoggedIn(empty($_SESSION['username']) ? false : true);
$navbar->render();
?>