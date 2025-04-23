<?php
session_start();
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Crop Management Blog</title>
    <link rel="stylesheet" href="home.css">
    <style>
        .contact-section {
            padding: 50px 0;
            background-color: #f9f9f9;
        }
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .contact-title {
            text-align: center;
            margin-bottom: 50px;
        }
        .contact-title h1 {
            font-size: 2.5em;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .contact-title p {
            font-size: 1.2em;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }
        .developers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        .developer-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .developer-card:hover {
            transform: translateY(-10px);
        }
        .developer-card h3 {
            font-size: 1.5em;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .developer-card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .contact-info {
            margin-top: 20px;
        }
        .contact-info p {
            margin: 10px 0;
        }
        .email-btn {
            display: inline-block;
            background-color: #2a9d8f;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }
        .email-btn:hover {
            background-color: #238b7f;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            color: #2a9d8f;
            margin: 0 10px;
            font-size: 1.2em;
            transition: color 0.3s ease;
        }
        .social-links a:hover {
            color: #238b7f;
        }
    </style>
</head>
<body>
    <section class="contact-section">
        <div class="contact-container">
            <div class="contact-title">
                <h1>Contact Our Team</h1>
                <p>Get in touch with our developers for any queries or support</p>
            </div>
            
            <div class="developers-grid">
                <div class="developer-card">
                    <h3>Adarsh Dwivedi</h3>
                    <p>Backend Developer</p>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i> adarshdwivedi9598@gmail.com</p>
                        <p><i class="fas fa-phone"></i> +91 98765 43210</p>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=adarshdwivedi9598@gmail.com&su=Query from Crop Management Blog" class="email-btn" target="_blank">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </a>
                        <div class="social-links">
                            <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="developer-card">
                    <h3>Niraj D. Nillawar</h3>
                    <p>Frontend Developer</p>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i> nirajnillawar@gmail.com</p>
                        <p><i class="fas fa-phone"></i> +91 98765 43211</p>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=nirajnillawar@gmail.com&su=Query from Crop Management Blog" class="email-btn" target="_blank">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </a>
                        <div class="social-links">
                            <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="developer-card">
                    <h3>Harsh Mishra</h3>
                    <p>System Architect</p>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i> harshmishrastp456@gmail.com</p>
                        <p><i class="fas fa-phone"></i> +91 98765 43212</p>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=harshmishrastp456@gmail.com&su=Query from Crop Management Blog" class="email-btn" target="_blank">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </a>
                        <div class="social-links">
                            <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="developer-card">
                    <h3>Mohit Yadav</h3>
                    <p>Feature Developer</p>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i> mohit.yadav@example.com</p>
                        <p><i class="fas fa-phone"></i> +91 98765 43213</p>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=mohit.yadav@example.com&su=Query from Crop Management Blog" class="email-btn" target="_blank">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </a>
                        <div class="social-links">
                            <a href="#" target="_blank"><i class="fab fa-github"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html> 