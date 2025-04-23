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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmers.in</title>
  <link rel="stylesheet" href="home.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <div class="header-content">
        <div class="logo">
            <i class="fas fa-leaf logo-icon"></i>
            <span>Farmacy</span>
        </div>
        <nav>
            <ul>
                <li><a href="#"><i class="fas fa-home nav-icon"></i> Home</a></li>
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
                <li><a href="contact.php"><i class="fas fa-envelope nav-icon"></i> Contact</a></li>
                <!-- <button class="lang-toggle" onclick="toggleLanguage()">हिंदी</button> -->
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

  <section class="we-care">
    <video autoplay muted loop playsinline class="background-video">
      <source src="agri1.mp4" type="video/mp4">
    </video>
    <h1>Cultivating<br>Tomorrow</h1>
    <p>Sustainable Farming Solutions for Modern Agriculture</p>
  </section>

  <h1 class="guidance">Crop Portfolio</h1>

  <div class="crop-guidance">
    <div class="crops">
      <div class="crop">
        <img src="https://cdn.agdaily.com/wp-content/uploads/2016/09/wheat.jpg" alt="Wheat">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Wheat">Wheat</a></div>
      </div>
      <div class="crop">
        <img src="https://media.istockphoto.com/id/622925154/photo/ripe-rice-in-the-field-of-farmland.jpg?s=170667a&w=0&k=20&c=EKziMyKjbd_MX5hBLdOaF7n-laF39wmoor-giK6rHg4=" alt="Rice">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Rice">Rice</a></div>
      </div>
      <div class="crop">
        <img src="https://www.aces.edu/wp-content/uploads/2018/08/shutterstock_-Zeljko-Radojko_field-corn.jpg" alt="Corn">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Maize">Corn</a></div>
      </div>
      <div class="crop">
        <img src="https://levitycropscience.com/wp-content/uploads/2021/05/Spring-Barley-2.jpg" alt="Barley">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Barley">Barley</a></div>
      </div>
      <div class="crop">
        <img src="https://media.npr.org/assets/img/2015/12/21/millet_enl-2eaf52b1cfd8315bebbd3dab5ae2ab259e6cce58-s1200.jpg" alt="Millet">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Millet">Millet</a></div>
      </div>
      <div class="crop">
        <img src="https://www.northstargenetics.ca/wp-content/uploads/2018/12/gs-post-1600x1100.jpg" alt="Soybean">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Soybean">Soybean</a></div>
      </div>
      <div class="crop">
        <img src="https://media.sciencephoto.com/image/c0508107/800wm/C0508107-Cotton_crop.jpg" alt="Cotton">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Cotton">Cotton</a></div>
      </div>
      <div class="crop">
        <img src="https://a-z-animals.com/media/2022/07/shutterstock_767632852.jpg" alt="Sugarcane">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Sugarcane">Sugarcane</a></div>
      </div>
      <div class="crop">
        <img src="https://image.freepik.com/free-photo/ripe-coffee-crop-tree-coffee-plantation-farm_3236-531.jpg" alt="Coffee">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Coffee">Coffee</a></div>
      </div>
      <div class="crop">
        <img src="https://thumbs.dreamstime.com/b/flowering-oilseed-rape-crop-field-flowering-oilseed-rape-crop-field-blooming-canola-flowers-rapeseed-agricultural-field-265386591.jpg" alt="Oil Seeds">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Mustard">Oil Seeds</a></div>
      </div>
      <div class="crop">
        <img src="https://thumbs.dreamstime.com/z/jute-plant-field-jute-cultivation-assam-india-jute-plant-field-jute-cultivation-assam-india-green-154952314.jpg" alt="Jute">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Jute">Jute</a></div>
      </div>
      <div class="crop">
        <img src="https://thumbs.dreamstime.com/z/potato-crop-against-backdrop-garden-green-147805126.jpg" alt="Potato">
        <div class="crop-name"><a href="https://en.wikipedia.org/wiki/Potato">Potato</a></div>
      </div>
    </div>
  </div>

  <h1 class="guidance">Products</h1>
  <div class="product-section">

    <div class="tabs">
      <button class="tab-btn active" onclick="showTab('crops')">Crops</button>
      <button class="tab-btn" onclick="showTab('tools')">Tools & Machines</button>
    </div>
    
    <div class="product-section" id="pro">
     
      <div id="crops" class="slider-container">
        <div class="product-slider">
          <div class="product-card"><img src="https://cdn.agdaily.com/wp-content/uploads/2016/09/wheat.jpg"><div class="product-name">Wheat</div><div class="price">₹25/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://i.pinimg.com/736x/d1/01/82/d101829599b58c1d938ebc32dbdd8085.jpg"><div class="product-name">Rice</div><div class="price">₹30/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://www.aces.edu/wp-content/uploads/2018/08/shutterstock_-Zeljko-Radojko_field-corn.jpg"><div class="product-name">Corn</div><div class="price">₹22/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://levitycropscience.com/wp-content/uploads/2021/05/Spring-Barley-2.jpg"><div class="product-name">Barley</div><div class="price">₹18/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://media.npr.org/assets/img/2015/12/21/millet_enl-2eaf52b1cfd8315bebbd3dab5ae2ab259e6cce58-s1200.jpg"><div class="product-name">Millet</div><div class="price">₹20/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://thumbs.dreamstime.com/z/potato-crop-against-backdrop-garden-green-147805126.jpg"><div class="product-name">Potato</div><div class="price">₹15/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://cdn.agdaily.com/wp-content/uploads/2016/09/wheat.jpg"><div class="product-name">Wheat</div><div class="price">₹25/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://cdnimg.webstaurantstore.com/images/products/extra_large/170440/1978319.jpg"><div class="product-name">Rice</div><div class="price">₹30/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://www.aces.edu/wp-content/uploads/2018/08/shutterstock_-Zeljko-Radojko_field-corn.jpg"><div class="product-name">Corn</div><div class="price">₹22/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://levitycropscience.com/wp-content/uploads/2021/05/Spring-Barley-2.jpg"><div class="product-name">Barley</div><div class="price">₹18/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://media.npr.org/assets/img/2015/12/21/millet_enl-2eaf52b1cfd8315bebbd3dab5ae2ab259e6cce58-s1200.jpg"><div class="product-name">Millet</div><div class="price">₹20/kg</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://thumbs.dreamstime.com/z/potato-crop-against-backdrop-garden-green-147805126.jpg"><div class="product-name">Potato</div><div class="price">₹15/kg</div><button class="add-btn">Add</button></div>
          
        </div>
      </div>
    
      
      <div id="tools" class="slider-container hidden">
        <div class="product-slider">
          <div class="product-card"><img src="https://bertiegreen.co.uk/wp-content/uploads/2015/05/Kubota-B2410-Compact-Tractor-Square.png"><div class="product-name">Mini Tractor</div><div class="price">₹1,50,000</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://www.huntgathergrow.com.au/assets/full/2901.jpg?20210127115606"><div class="product-name">Hand Hoe</div><div class="price">₹500</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://www.machinerydukaan.com/assets/images/products/76_200615020048.jpg"><div class="product-name">Power Tiller</div><div class="price">₹65,000</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://i.etsystatic.com/27051428/r/il/c6033e/3258073366/il_1588xN.3258073366_9ebf.jpg"><div class="product-name">Garden Kit</div><div class="price">₹1,200</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://5.imimg.com/data5/SELLER/Default/2022/7/OB/DQ/BX/126539621/51fx0xdoh5l-500x500.jpg"><div class="product-name">Solar Sprayer</div><div class="price">₹3,200</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://fieldmaster.co.nz/images/thumbs/0000375_mf-disc-ploughs_1000.jpeg"><div class="product-name">Plough</div><div class="price">₹5,500</div><button class="add-btn">Add</button></div>
          
    
          
          <div class="product-card"><img src="https://bertiegreen.co.uk/wp-content/uploads/2015/05/Kubota-B2410-Compact-Tractor-Square.png"><div class="product-name">Mini Tractor</div><div class="price">₹1,50,000</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://www.kisanstore.com/media/catalog/product/cache/cd308ff1de3a305f1d17f5f6cd8b8273/h/a/hand_hoe.jpg"><div class="product-name">Hand Hoe</div><div class="price">₹500</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://cdn.moglix.com/p/McK5rXmeYslQ8-xxlarge.jpg"><div class="product-name">Power Tiller</div><div class="price">₹65,000</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://rukminim2.flixcart.com/image/850/1000/kjabs7k0-0/tool-set/v/4/f/green-hand-tools-kit-12-pieces-home-garden-tools-kit-for-original-imafyurh9z9ufrsj.jpeg"><div class="product-name">Garden Kit</div><div class="price">₹1,200</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://5.imimg.com/data5/SELLER/Default/2021/8/VU/BY/NO/135019412/solar-sprayer-500x500.jpg"><div class="product-name">Solar Sprayer</div><div class="price">₹3,200</div><button class="add-btn">Add</button></div>
          <div class="product-card"><img src="https://www.tractorjunction.com/assets/images/machines-category/plough.png"><div class="product-name">Plough</div><div class="price">₹5,500</div><button class="add-btn">Add</button></div>
          
        </div>
      </div>
    </div>

  </div>

  <div class="services-section">
  <h2>Our Services</h2>
  <div class="services-container">
    <div class="service-card" data-service="Weather Forecast"><a href="https://weathercheck.42web.io/?i=1" style="text-decoration: none; color: black; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">Weather Forecast</a></div>
    <div class="service-card" data-service="Pest Control"><a href="pest_control.php" style="text-decoration: none; color: black; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">Pest Control</a></div>
    <div class="service-card" data-service="Machinery Rental"><a href="machinery_rental.html" style="text-decoration: none; color: black; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">Machinery rental</a></div>
    <div class="service-card" data-service="Market Prices"><a href="crop_prices.html" style="text-decoration: none; color: black; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">Crop Prices</a></div>
    <div class="service-card" data-service="Soil Health"><a href="soil_health.html" style="text-decoration: none; color: black; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">Soil health</a></div>
    <div class="service-card" data-service="Community Forum"><a href="home.php" style="text-decoration: none; color: black; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);">Community forum</a></div>
  </div>
</div>

  <div class="service-preview" id="servicePreview">
    <h3 id="previewTitle">Title</h3>
    <p id="previewDescription">More info about the service will appear here.</p>
  </div>

  <footer>
  <div class="footer-container">
    <div class="team-members">
      <div class="member">
        <h3>Niraj Nillawar</h3>
        <p>Developer</p>
      </div>
      <div class="member">
        <h3>Harsh Mishra</h3>
        <p>Developer</p>
      </div>
      <div class="member">
        <h3>Adarsh Dwivedi</h3>
        <p>Developer</p>
      </div>
      <div class="member">
        <h3>Mohit Yadav</h3>
        <p>Developer</p>
      </div>
    </div>
    <div class="copyright">
      <p>&copy; 2025 Agriculture Machinery Rental. All rights reserved.</p>
    </div>
  </div>
</footer>

<style>
  footer {
    background-color: #2a9d8f;
    color: white;
    padding: 2rem 0;
    text-align: center;
  }

  .footer-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .team-members {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
  }

  .member h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
  }

  .member p {
    font-size: 1rem;
    color: #e0f7fa;
  }

  .copyright {
    font-size: 1rem;
    margin-top: 1.5rem;
  }

  .member, .copyright {
    text-align: center;
  }

  @media (max-width: 768px) {
    .team-members {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 480px) {
    .team-members {
      grid-template-columns: 1fr;
    }
  }

  .user-profile {
    position: relative;
    margin-left: 20px;
    display: flex;
    align-items: center;
  }
  
  .profile-btn {
    background: linear-gradient(135deg, rgba(42, 157, 143, 0.1), rgba(42, 157, 143, 0.05));
    border: none;
    color: #2a9d8f;
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    padding: 8px 16px;
    font-size: 16px;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    border-radius: 30px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
  }
  
  .profile-btn:hover {
    color: #238b7f;
    background: linear-gradient(135deg, rgba(42, 157, 143, 0.15), rgba(42, 157, 143, 0.1));
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    transform: translateY(-1px);
  }
  
  .profile-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }
  
  .profile-btn i.fa-user-circle {
    font-size: 22px;
    color: #2a9d8f;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    background: rgba(255, 255, 255, 0.7);
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
  }
  
  .profile-btn:hover i.fa-user-circle {
    transform: scale(1.1);
    color: #238b7f;
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.08);
  }
  
  .username-container {
    position: relative;
    display: inline-block;
    padding: 0 5px;
  }
  
  .username {
    font-weight: 600;
    color: #333;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    padding: 6px 12px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.7);
    font-size: 15px;
    letter-spacing: 0.3px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  }
  
  .username-container:hover .username {
    background: rgba(255, 255, 255, 0.9);
    transform: translateY(-1px);
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.08);
  }
  
  .hover-logout {
    position: absolute;
    top: calc(100% + 10px);
    left: 50%;
    transform: translateX(-50%);
    background: white;
    padding: 14px 24px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    display: none;
    white-space: nowrap;
    z-index: 1001;
    animation: fadeIn 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    border: 1px solid rgba(220, 53, 69, 0.1);
    min-width: 180px;
  }
  
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translate(-50%, -10px);
    }
    to {
      opacity: 1;
      transform: translate(-50%, 0);
    }
  }
  
  .hover-logout::before {
    content: '';
    position: absolute;
    top: -6px;
    left: 50%;
    transform: translateX(-50%);
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-bottom: 6px solid white;
  }
  
  .username-container:hover .hover-logout {
    display: block;
  }
  
  .hover-logout a {
    color: #dc3545;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    padding: 10px 0;
    justify-content: center;
  }
  
  .hover-logout a:hover {
    color: #bb2d3b;
    transform: translateX(3px);
  }
  
  .hover-logout i {
    font-size: 16px;
    background: rgba(220, 53, 69, 0.1);
    padding: 10px;
    border-radius: 50%;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(220, 53, 69, 0.1);
  }
  
  .hover-logout a:hover i {
    background: rgba(220, 53, 69, 0.2);
    transform: rotate(90deg);
    box-shadow: 0 3px 8px rgba(220, 53, 69, 0.15);
  }
  
  /* Add a subtle animation for the logout text */
  .hover-logout a span {
    position: relative;
    display: inline-block;
  }
  
  .hover-logout a:hover span {
    animation: pulse 1s infinite;
  }
  
  @keyframes pulse {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.05);
    }
    100% {
      transform: scale(1);
    }
  }
</style>
<script>
    // Initialize Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = 1;
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.crop').forEach((crop) => {
      observer.observe(crop);
    });

    // Touch event handling
    function handleTouch(event) {
      event.currentTarget.classList.toggle('hover');
    }
    
    document.querySelectorAll('.crop').forEach(crop => {
      crop.addEventListener('touchstart', handleTouch, false);
    });

    // Service preview functionality
    const serviceCards = document.querySelectorAll('.service-card');
    const preview = document.getElementById('servicePreview');
    const previewTitle = document.getElementById('previewTitle');
    const previewDescription = document.getElementById('previewDescription');

    const serviceInfo = {
      'Crop Advisory': 'Get expert advice on what crops to grow and how to manage them.',
      'Weather Forecast': 'Stay updated with real-time weather forecasts for your region.',
      'Pest Control': 'Learn about best practices and tools to control pests effectively.',
      'Irrigation Management': 'Optimize your water usage with smart irrigation techniques.',
      'Machinery Rental': 'Find and rent the right machinery for your agricultural needs.',
      'Market Prices': 'Track daily market prices of crops and plan your sales accordingly.',
      'Soil Health': 'Analyze and improve your soil\'s fertility and health.',
      'Community Forum': 'Connect with fellow farmers and share knowledge.',
    };

    let hoverTimer;

    serviceCards.forEach(card => {
      card.addEventListener('mouseenter', (e) => {
        const service = e.target.dataset.service;
        hoverTimer = setTimeout(() => {
          previewTitle.textContent = service;
          previewDescription.textContent = serviceInfo[service];
          const rect = e.target.getBoundingClientRect();
          preview.style.top = `${rect.bottom + window.scrollY + 10}px`;
          preview.style.left = `${rect.left + window.scrollX}px`;
          preview.classList.add('visible');
        }, 500);
      });

      card.addEventListener('mouseleave', () => {
        clearTimeout(hoverTimer);
        preview.classList.remove('visible');
      });
    });

    // Dropdown functionality
    document.addEventListener('DOMContentLoaded', function() {
      const dropdowns = document.querySelectorAll('.dropdown');
      
      dropdowns.forEach(dropdown => {
        const btn = dropdown.querySelector('.dropdown-btn');
        
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          dropdown.classList.toggle('open');
        });
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
          dropdowns.forEach(dropdown => {
            dropdown.classList.remove('open');
          });
        }
      });
    });

    // Tab functionality
    function showTab(tabName) {
      const tabs = document.querySelectorAll('.slider-container');
      const buttons = document.querySelectorAll('.tab-btn');
      
      tabs.forEach(tab => {
        tab.classList.add('hidden');
      });
      
      buttons.forEach(btn => {
        btn.classList.remove('active');
      });
      
      document.getElementById(tabName).classList.remove('hidden');
      event.currentTarget.classList.add('active');
    }

    // Profile and logout functionality
    document.addEventListener('DOMContentLoaded', function() {
      const profileBtn = document.querySelector('.profile-btn');
      
      profileBtn.addEventListener('click', function(e) {
        e.preventDefault();
      });
      
      function confirmLogout() {
        if (confirm('Are you sure you want to logout?')) {
          window.location.href = 'logout.php';
          return false;
        }
        return false;
      }
    });
</script>
</body>
</html>