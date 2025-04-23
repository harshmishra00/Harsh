<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT username FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);
$username = $user['username'];
?>
<header>
    <div class="header-content">
        <div class="logo">
            <i class="fas fa-leaf logo-icon"></i>
            <span>Farmacy</span>
        </div>
        <nav>
            <ul>
                <li><a href="home01.php"><i class="fas fa-home nav-icon"></i> Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-btn">
                        <i class="fas fa-lightbulb nav-icon"></i> Services
                        <i class="fas fa-chevron-down arrow"></i> 
                    </a>
                    <div class="dropdown-content">
                        <a href="home.php" class="btn btn-info m-2">Blog</a>
                        <a href="pest_control.php" class="btn btn-info m-2">Machinery Rental</a>
                        <a href="https://weathercheck.42web.io/?i=1" class="btn btn-info m-2">Weather Forecast</a>
                        <a href="pest_control.php" class="btn btn-info m-2">Pest Control</a>
                        <a href="crop_prices.html" class="btn btn-info m-2">Crop Prices</a>
                        <a href="soil_health.html" class="btn btn-info m-2">Soil health</a>
                    </div>
                </li>
                <li><a href="#pro"><i class="fas fa-seedling nav-icon"></i> Products</a></li>
                <li><a href="about.php"><i class="fas fa-info-circle nav-icon"></i> About</a></li>
                <li><a href="#"><i class="fas fa-envelope nav-icon"></i> Contact</a></li>
            </ul>
        </nav>
        <div class="user-profile">
            <button class="profile-btn">
                <i class="fas fa-user-circle"></i>
                <div class="username-container">
                    <span class="username"><?php echo htmlspecialchars($username); ?></span>
                    <div class="hover-logout">
                        <a href="#" onclick="return confirmLogout();"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
                    </div>
                </div>
            </button>
        </div>
    </div>
</header>

<script>
    function confirmLogout() {
        if (confirm('Are you sure you want to logout?')) {
            window.location.href = 'logout.php';
            return false;
        }
        return false;
    }
</script> 