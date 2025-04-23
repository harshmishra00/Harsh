<?php
session_start();
require 'db.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

   
    if (empty($username)) {
        $error = "Username is required.";
    } elseif (strlen($username) < 3 || strlen($username) > 20) {
        $error = "Username must be between 3 and 20 characters.";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $error = "Username can only contain letters, numbers and underscores.";
    } else {
        
        $check_username = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($check_username) > 0) {
            $error = "Username already exists. Please choose a different username.";
        }
    }

    
    if (empty($error)) {
        if (empty($password)) {
            $error = "Password is required.";
        } elseif (strlen($password) < 8) {
            $error = "Password must be at least 8 characters long.";
        } elseif (!preg_match("/[A-Z]/", $password)) {
            $error = "Password must contain at least one uppercase letter.";
        } elseif (!preg_match("/[a-z]/", $password)) {
            $error = "Password must contain at least one lowercase letter.";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $error = "Password must contain at least one number.";
        } elseif (!preg_match("/[!@#$%^&*]/", $password)) {
            $error = "Password must contain at least one special character (!@#$%^&*).";
        }
    }
  
    if (empty($error) && $password !== $confirm_password) {
        $error = "Passwords do not match.";
    }

    if (empty($error)) {
        // Check if email already exists
        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check_email) > 0) {
            $error = "Email already exists. Please use a different email.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if (mysqli_query($conn, $query)) {
                $success = "Registration successful! You can now login.";
                // Redirect to login page after 2 seconds
                header("refresh:1;url=login.php");
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Farmacy Sign Up</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --gradient1: #FFFDEE;  /* Light cream from Gradient 1 */
            --gradient2: #E2FBCE;  /* Light green from Gradient 2 */
            --gradient3: #E3EF26;  /* Bright yellow-green from Gradient 3 */
            --gradient4: #076653;  /* Deep green from Gradient 4 */
            --text: #0C342C;      /* Dark green for text */
            --background: #FFFDEE; /* Light cream background */
        }

        body {
            background: linear-gradient(135deg, var(--gradient2) 0%, var(--gradient4) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        @media (max-width: 768px) {
            body {
                justify-content: center;
                padding-right: 20px;
            }
        }

        .container {
            background-color: rgba(255, 253, 238, 0.97);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;  
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: transform 0.3s ease;
            margin-left: 45%;
        }

        @media (max-width: 480px) {
            .container {
                padding: 24px;
                width: 95%; 
            }
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .signup form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-container {
            position: relative;
            width: 100%;
        }

        .input-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text);
            font-size: 19px;
        }

        .input-container input[type="text"],
        .input-container input[type="password"],
        .input-container input[type="email"] {
            padding-left: 45px; 
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            padding: 15px;
            border: 2px solid #e1e1e1;
            border-radius: 12px;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
            background-color: var(--background);
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: var(--gradient4);
            box-shadow: 0 0 15px rgba(7, 102, 83, 0.2);
            transform: scale(1.01);
        }

        .btn {
            background: linear-gradient(45deg, var(--gradient4), var(--gradient3));
            color: white;
            padding: 15px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn:hover {
            background: linear-gradient(45deg, var(--gradient3), var(--gradient4));
            box-shadow: 0 5px 15px rgba(7, 102, 83, 0.3);
            transform: translateY(-2px);
        }

        label {
            display: flex;
            align-items: center;
            gap: 13px;
            color: var(--text);
            font-size: 15px;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--gradient4);
        }

        .hr-with-text {
            position: relative;
            text-align: center;
            margin: 24px 0;
        }

        .hr-with-text::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            width: 45%;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--gradient4));
        }

        .hr-with-text::after {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            width: 45%;
            height: 1px;
            background: linear-gradient(to left, transparent, var(--gradient4));
        }

        .hr-with-text span {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 0 15px;
            color: var(--text);
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        p {
            color: var(--text);
            font-size: 0.95rem;
            text-align: center;
            line-height: 1.6;
        }

        p a {
            color: var(--gradient4);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        p a:hover {
            color: var(--gradient3);
        }

        .quote-container {
            position: absolute;
            left: 8%;
            max-width: 500px;
            color: white;
            text-align: left;
            padding: 48px;
            transform: translateY(-20px);
            animation: float 6s ease-in-out infinite;
            transition: all 0.4s ease;
        }

        @keyframes float {
            0%, 100% { transform: translateY(-20px); }
            50% { transform: translateY(0px); }
        }

        .quote-box {
            position: relative;
            background: rgba(7, 102, 83, 0.15);
            border-radius: 30px;
            padding: 48px;
            box-shadow: 
                0 10px 20px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 0 20px rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            overflow: hidden;
            transition: all 0.4s ease;
            animation: colorChange 10s infinite alternate;
        }

        @keyframes colorChange {
            0% {
                background: rgba(226, 251, 206, 0.15);
                border-left: 4px solid var(--gradient2);
            }
            50% {
                background: rgba(227, 239, 38, 0.15);
                border-left: 4px solid var(--gradient3);
            }
            100% {
                background: rgba(7, 102, 83, 0.15);
                border-left: 4px solid var(--gradient4);
            }
        }

        .quote-box:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 
                0 15px 30px rgba(0, 0, 0, 0.2),
                0 0 0 2px rgba(255, 255, 255, 0.2),
                inset 0 0 30px rgba(255, 255, 255, 0.1);
            animation-play-state: paused;
        }

        .quote-text {
            font-size: 32px;
            font-weight: 400;
            line-height: 1.6;
            margin-bottom: 32px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            font-family: 'Georgia', serif;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .quote-box:hover .quote-text {
            transform: scale(1.02);
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
        }

        .quote-icon {
            position: absolute;
            font-size: 128px;
            opacity: 0.1;
            top: -20px;
            left: -20px;
            color: white;
            font-family: 'Georgia', serif;
            z-index: 0;
            transition: all 0.4s ease;
        }

        .quote-box:hover .quote-icon {
            transform: rotate(-10deg) scale(1.1);
            opacity: 0.15;
        }

        .quote-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 24px;
            margin-top: 24px;
            transition: all 0.3s ease;
        }

        .quote-box:hover .quote-footer {
            border-top-color: rgba(255, 255, 255, 0.3);
        }

        .quote-author {
            font-size: 22px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            animation: textColorChange 10s infinite alternate;
        }

        @keyframes textColorChange {
            0% { color: var(--gradient4); }
            50% { color: var(--gradient3); }
            100% { color: var(--gradient4); }
        }

        .quote-role {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
            font-style: italic;
            transition: all 0.3s ease;
        }

        .quote-box:hover .quote-role {
            color: rgba(255, 255, 255, 0.9);
        }

        @media (max-width: 1200px) {
            .quote-container {
                display: none;
            }
            .container {
                margin-left: 0;
            }
        }

        .signup-btn {
            width: 100%;
            margin-top: 15px;
            background: linear-gradient(45deg, var(--gradient4), var(--gradient3));
        }

        .signup-btn:hover i {
            transform: translateX(5px);
        }

        .signup-btn:hover {
            background: linear-gradient(45deg, var(--gradient3), var(--gradient4));
            box-shadow: 0 5px 15px rgba(7, 102, 83, 0.3);
            transform: translateY(-2px);
        }

        .name-container {
            display: flex;
            gap: 15px;
        }

        .name-container .input-container {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="quote-container">
        <div class="quote-box">
            <div class="quote-icon">"</div>
            <p class="quote-text">Agriculture is our wisest pursuit, because it will in the end contribute most to real wealth, good morals, and happiness.</p>
            <div class="quote-footer">
                <p class="quote-author">Thomas Jefferson</p>
                <p class="quote-role">3rd President of the United States & Farmer</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="signup">
            <h2>Create Account</h2>
            <?php if($error): ?>
                <div class="error" style="color: red; margin-bottom: 15px;"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if($success): ?>
                <div class="success" style="color: green; margin-bottom: 15px;"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn">Sign Up</button>
            </form>
            <div class="hr-with-text">
                <span>or</span>
            </div>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>

</html>