<?php
session_start();

// Initialize variables
$isLoggedIn = isset($_SESSION['user_id']);
$username = $isLoggedIn ? $_SESSION['username'] : '';

// Error handling for missing files
$headerExists = file_exists('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Pest Control Services | Farmacy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #388E3C;
            --dark-color: #2E7D32;
            --light-color: #f4f4f4;
            --accent-color: #FFC107;
            --text-dark: #333;
            --text-light: #666;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            line-height: 1.6;
            color: var(--text-dark);
            background-color: #f8f9fa;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://www.gardentech.com/-/media/project/oneweb/gardentech/images/blog/what-is-integrated-pest-management/what-is-header.jpg') center/cover;
            color: white;
            text-align: center;
            padding: 8rem 1rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(76, 175, 80, 0.3), rgba(40, 167, 69, 0.3));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .cta-button {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 1rem 2.5rem;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .cta-button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
            color: white;
        }

        /* Sections */
        .section {
            padding: 6rem 1rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .section-header p {
            color: var(--text-light);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* How It Works */
        .steps-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }

        .step-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-color);
            transform: scaleX(0);
            transition: var(--transition);
        }

        .step-card:hover {
            transform: translateY(-10px);
        }

        .step-card:hover::before {
            transform: scaleX(1);
        }

        .step-card i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .step-card:hover i {
            transform: scale(1.1);
        }

        .step-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .step-card p {
            color: var(--text-light);
            line-height: 1.8;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: var(--transition);
            overflow: hidden;
            position: relative;
        }

        .service-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: var(--transition);
        }

        .service-content {
            padding: 2rem;
            text-align: center;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .service-card p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-card:hover img {
            transform: scale(1.1);
        }

        .service-btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: var(--transition);
        }

        .service-btn:hover {
            background: var(--secondary-color);
            color: white;
        }

        /* Sectors Grid */
        .sectors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            list-style: none;
        }

        .sectors-grid li {
            padding: 1.5rem;
            background: white;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
            font-weight: 500;
        }

        .sectors-grid li:hover {
            transform: translateY(-5px);
            background: var(--primary-color);
            color: white;
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 4rem 1rem 2rem;
            text-align: center;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section {
            text-align: left;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
        }

        .footer-section p {
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            color: white;
            font-size: 1.5rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .section {
                padding: 4rem 1rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .steps-container,
            .services-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</head>
<body>
    <?php if ($headerExists): ?>
        <?php include 'includes/header.php'; ?>
    <?php endif; ?>

    <section class="hero">
        <div class="hero-content">
            <h1>Protect Your Home, Family, and Peace of Mind</h1>
            <p>Get professional pest control services tailored to your needs. Our experts ensure a safe and pest-free environment for your loved ones.</p>
            <a href="quote.php" class="cta-button">Get Free Quote</a>
        </div>
    </section>

    <section class="section" id="how-it-works">
        <div class="section-header">
            <h2>How It Works</h2>
            <p>Simple steps to get rid of pests from your property</p>
        </div>
        <div class="steps-container">
            <div class="step-card animate">
                <i class="fas fa-comment-alt"></i>
                <h3>1. Get Free Quotes</h3>
                <p>Contact us with your needs. Submit quote form or call us at 9911918545</p>
            </div>
            <div class="step-card animate">
                <i class="fas fa-calendar-check"></i>
                <h3>2. Schedule Service</h3>
                <p>Our experts will evaluate your place and provide a customized service plan</p>
            </div>
            <div class="step-card animate">
                <i class="fas fa-laugh-beam"></i>
                <h3>3. Rest Assured</h3>
                <p>Relax while our verified partners complete the job efficiently and safely</p>
            </div>
        </div>
    </section>

    <section class="section" id="services">
        <div class="section-header">
            <h2>Our Pest Control Services</h2>
            <p>Comprehensive pest control solutions for your home and business</p>
        </div>
        <div class="services-grid">
            <div class="service-card animate">
                <img src="https://www.shutterstock.com/image-vector/cartoon-termites-eating-wood-vector-600nw-1654713202.jpg" alt="Termite Control">
                <div class="service-content">
                    <h3>Termite Control</h3>
                    <p>Professional termite inspection and eradication services</p>
                    <a href="quote.php?service=termite" class="service-btn">Learn More</a>
                </div>
            </div>
            <div class="service-card animate">
                <img src="https://static.vecteezy.com/system/resources/previews/005/677/782/non_2x/funny-mosquito-cartoon-flying-insects-vector.jpg" alt="Mosquito Control">
                <div class="service-content">
                    <h3>Mosquito Control</h3>
                    <p>Effective mosquito prevention and elimination solutions</p>
                    <a href="quote.php?service=mosquito" class="service-btn">Learn More</a>
                </div>
            </div>
            <div class="service-card animate">
                <img src="https://img.freepik.com/vecteurs-premium/cute-cockroach-vector-illustration-dessin-anime-fond-blanc_1025757-24491.jpg?w=996" alt="Cockroach Control">
                <div class="service-content">
                    <h3>Cockroach Control</h3>
                    <p>Complete cockroach elimination and prevention services</p>
                    <a href="quote.php?service=cockroach" class="service-btn">Learn More</a>
                </div>
            </div>
            <div class="service-card animate">
                <img src="https://pics.craiyon.com/2023-07-20/e48ccde42d69451fb96e9b9caae467d3.webp" alt="Rat Control">
                <div class="service-content">
                    <h3>Rat Control</h3>
                    <p>Safe and effective rodent control and prevention</p>
                    <a href="quote.php?service=rat" class="service-btn">Learn More</a>
                </div>
            </div>
            <div class="service-card animate">
                <img src="https://static.vecteezy.com/system/resources/previews/023/155/069/original/cute-character-of-gecko-lizard-vector.jpg" alt="Lizard Control">
                <div class="service-content">
                    <h3>Lizard Control</h3>
                    <p>Professional lizard prevention and removal services</p>
                    <a href="quote.php?service=lizard" class="service-btn">Learn More</a>
                </div>
            </div>
            <div class="service-card animate">
                <img src="https://i.pinimg.com/originals/60/e7/32/60e73200459e1d267ed31636a5f24aea.png" alt="Ant Control">
                <div class="service-content">
                    <h3>Ant Control</h3>
                    <p>Complete ant colony elimination and prevention</p>
                    <a href="quote.php?service=ant" class="service-btn">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <h2>Special Services</h2>
            <p>Additional services to maintain a clean and healthy environment</p>
        </div>
        <div class="services-grid">
            <div class="service-card animate">
                <img src="https://interiordesigntalks.com/wp-content/uploads/2022/09/natural-pest-controlsaddasdasdasd.png" alt="Herbal Pest Control">
                <div class="service-content">
                    <h3>Herbal Pest Control</h3>
                    <p>Eco-friendly natural pest solutions for your home</p>
                    <a href="quote.php?service=herbal" class="service-btn">Learn More</a>
                </div>
            </div>
            <div class="service-card animate">
                <img src="https://pscstaffing.com/wp-content/uploads/2019/07/Housekeeping-PSC-Staffing-1200x800.jpg" alt="Housekeeping & Cleaning">
                <div class="service-content">
                    <h3>Housekeeping & Cleaning</h3>
                    <p>Professional cleaning and maintenance services</p>
                    <a href="quote.php?service=cleaning" class="service-btn">Learn More</a>
                </div>
            </div>
            <div class="service-card animate">
                <img src="https://www.aladdinorientalrug.com/images/coronavirus/sanitization-disinfection-services-2.jpg" alt="Sanitization & Disinfection">
                <div class="service-content">
                    <h3>Sanitization & Disinfection</h3>
                    <p>Complete space sanitization and disinfection services</p>
                    <a href="quote.php?service=sanitization" class="service-btn">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="sectors">
        <div class="section-header">
            <h2>Sectors We Serve</h2>
            <p>Comprehensive pest control solutions for various industries</p>
        </div>
        <ul class="sectors-grid">
            <li>Residential</li>
            <li>Commercial</li>
            <li>Industrial & Manufacturing</li>
            <li>Food Industry</li>
            <li>Restaurant</li>
            <li>Warehouse & Logistics</li>
            <li>Hospitality & Hotel</li>
            <li>Pharmaceuticals</li>
            <li>Information Technology</li>
            <li>Banking & Finance</li>
            <li>Airport & Transportation</li>
            <li>Hospital & Healthcare</li>
            <li>Retail Sector</li>
            <li>Housing Society</li>
            <li>Education Sector</li>
            <li>Garment & Textile</li>
            <li>Real Estate</li>
            <li>Pre-Construction</li>
            <li>Post-Construction</li>
            <li>Commercial Kitchen</li>
        </ul>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>We are committed to providing professional pest control services with a focus on safety, effectiveness, and customer satisfaction.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p><i class="fas fa-phone"></i> 9911918545</p>
                <p><i class="fas fa-envelope"></i> email@example.com</p>
                <p><i class="fas fa-map-marker-alt"></i> 123 Street Name, City, Country</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <p><a href="about.php">About Us</a></p>
                <p><a href="services.php">Services</a></p>
                <p><a href="quote.php">Get Quote</a></p>
                <p><a href="contact.php">Contact Us</a></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Farmacy. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.service-card, .step-card').forEach(el => {
            observer.observe(el);
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html> 