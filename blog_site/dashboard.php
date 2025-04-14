<?php
session_start();
require 'C:\xampp\htdocs\blog_site\db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT username FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);
$username = $user['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Farmers.in - Dashboard</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .background-video {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    .we-care {
      position: relative;
      height: 80vh;
      color: white;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: rgba(0, 0, 0, 0.6);
    }

    .crop img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    .tab-pane img {
      object-fit: cover;
      height: 200px;
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.2rem;
    }

    .btn-outline-light {
      margin-left: 1rem;
    }

    .tab-pane {
      min-height: 250px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <i class="fas fa-leaf me-2"></i> Farmers.in
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-home"></i> Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-lightbulb"></i> Services
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Service 1</a></li>
            <li><a class="dropdown-item" href="#">Service 2</a></li>
            <li><a class="dropdown-item" href="#">Service 3</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="#pro"><i class="fas fa-seedling"></i> Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-info-circle"></i> About</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-envelope"></i> Contact</a></li>
      </ul>
      <div class="d-flex align-items-center">
        <a href="home.php" class="btn btn-warning me-2">Go to Blog</a>
        <a href="logout.php" class="btn btn-outline-light">Logout (<?= htmlspecialchars($username) ?>)</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="we-care bg-dark">
  <video autoplay muted loop playsinline class="background-video">
    <source src="agri1.mp4" type="video/mp4">
  </video>
  <div class="container">
    <h1 class="display-4 fw-bold">Cultivating<br>Tomorrow</h1>
    <p class="lead">Sustainable Farming Solutions for Modern Agriculture</p>
  </div>
</section>

<!-- Crop Portfolio -->
<div class="container my-5">
  <h2 class="text-center mb-4">Crop Portfolio</h2>
  <div class="row g-4">
    <?php
    // Fetch crop portfolio from database (or keep the hardcoded values)
    $crops = [
      ['Wheat', 'https://cdn.agdaily.com/wp-content/uploads/2016/09/wheat.jpg'],
      ['Corn', 'https://media.istockphoto.com/id/1344519078/photo/corn-field.jpg'],
      ['Rice', 'https://static.toiimg.com/thumb/msid-77987538,imgsize-877418,width-400,resizemode-4/77987538.jpg'],
      ['Barley', 'https://i.pinimg.com/originals/00/91/5b/00915b4d76552c4b435f376f3628d14f.jpg']
    ];
    foreach ($crops as $crop) {
      echo '
      <div class="col-md-3">
        <div class="card crop">
          <img src="' . $crop[1] . '" alt="' . $crop[0] . '" class="card-img-top">
          <div class="card-body text-center">
            <h5 class="card-title"><a href="https://en.wikipedia.org/wiki/' . $crop[0] . '" target="_blank">' . $crop[0] . '</a></h5>
          </div>
        </div>
      </div>';
    }
    ?>
  </div>
</div>

<!-- Product Tabs -->
<div class="container my-5" id="pro">
  <h2 class="text-center mb-4">Products</h2>
  <ul class="nav nav-tabs justify-content-center" id="productTabs">
    <li class="nav-item">
      <button class="nav-link active" onclick="showTab('crops')">Crops</button>
    </li>
    <li class="nav-item">
      <button class="nav-link" onclick="showTab('tools')">Tools & Machines</button>
    </li>
  </ul>
  <div class="tab-content mt-4">
    <div id="crops" class="tab-pane fade show active">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Crop">
            <div class="card-body">
              <h5 class="card-title">Sample Crop</h5>
              <p class="card-text">Description of crop product.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="tools" class="tab-pane fade">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Tool">
            <div class="card-body">
              <h5 class="card-title">Sample Tool</h5>
              <p class="card-text">Description of tool or machine.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Services -->
<div class="container my-5">
  <h2 class="text-center">Our Services</h2>
  <div class="row g-3 mt-4">
    <?php
    $services = [
      'Crop Advisory', 'Weather Forecast', 'Pest Control', 'Irrigation Management',
      'Machinery Rental', 'Market Prices', 'Soil Health', 'Community Forum'
    ];
    foreach ($services as $service) {
      $link = $service === 'Pest Control' ? 'pest_control.php' : '#';
      echo '
      <div class="col-md-3">
        <a href="' . $link . '" class="btn btn-outline-success w-100">' . $service . '</a>
      </div>';
    }
    ?>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function showTab(tabId) {
    document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
    document.getElementById(tabId).classList.add('show', 'active');
  }
</script>

</body>
</html>
