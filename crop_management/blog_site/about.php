<?php
session_start();
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Crop Management Blog</title>
    <link rel="stylesheet" href="home.css">
    <style>
        .team-section {
            padding: 50px 0;
            background-color: #f9f9f9;
        }
        .team-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .team-title {
            text-align: center;
            margin-bottom: 50px;
        }
        .team-title h1 {
            font-size: 2.5em;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .team-title p {
            font-size: 1.2em;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }
        .team-members {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        .team-member {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .team-member:hover {
            transform: translateY(-10px);
        }
        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
        }
        .team-member h3 {
            font-size: 1.5em;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .team-member p {
            color: #666;
            line-height: 1.6;
        }
        .mission-section {
            padding: 50px 0;
            background-color: #fff;
        }
        .mission-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        .mission-content h2 {
            font-size: 2em;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .mission-content p {
            font-size: 1.1em;
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="team-section">
        <div class="team-container">
            <div class="team-title">
                <h1>Our Team</h1>
                <p>Meet the passionate individuals behind the Crop Management Blog</p>
            </div>
            
            <div class="team-members">
                <div class="team-member">
                    <h3>Adarsh Dwivedi</h3>
                    <p>Developer</p>
                    <p>Specializing in backend development and database management, Adarsh ensures our platform runs smoothly and efficiently.</p>
                </div>
                
                <div class="team-member">
                    <h3>Niraj D. Nillawar</h3>
                    <p>Developer</p>
                    <p>With expertise in frontend development and user experience, Niraj creates intuitive and engaging interfaces for our users.</p>
                </div>
                
                <div class="team-member">
                    <h3>Harsh Mishra</h3>
                    <p>Developer</p>
                    <p>Focusing on system architecture and integration, Harsh ensures seamless communication between different platform components.</p>
                </div>
                
                <div class="team-member">
                    <h3>Mohit Yadav</h3>
                    <p>Developer</p>
                    <p>Specializing in feature development and testing, Mohit helps implement new functionalities while maintaining platform stability.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mission-section">
        <div class="mission-content">
            <h2>Our Mission</h2>
            <p>We created this website with a clear vision: to empower farmers and agricultural enthusiasts with knowledge, tools, and a supportive community. Our platform serves as a bridge between traditional farming wisdom and modern agricultural technology.</p>
            <p>Through our blog posts, expert insights, and interactive features, we aim to:</p>
            <ul style="list-style: none; padding: 0;">
                <li>• Share practical farming techniques and best practices</li>
                <li>• Connect farmers with the latest agricultural innovations</li>
                <li>• Foster a community of knowledge sharing and support</li>
                <li>• Promote sustainable and efficient farming methods</li>
            </ul>
            <p>Join us in our mission to revolutionize modern agriculture through knowledge sharing and community building.</p>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html> 