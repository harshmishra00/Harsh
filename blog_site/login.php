<?php
session_start();
require 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: home01.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacy Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            background-color: rgba(255, 253, 238, 0.97);  /* Using gradient1 color with opacity */
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

        .login form {
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
        .input-container input[type="password"] {
            padding-left: 45px; 
        }

        .social-signin {
            position: relative;
        }

        .social-signin i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 19px;
        }

        .google-signin i {
            color: #DB4437;
        }

        .apple-signin i {
            color: #000000;
        }

        input[type="text"],
        input[type="password"] {
            padding: 15px;
            border: 2px solid #e1e1e1;
            border-radius: 12px;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
            background-color: var(--background);
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
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

        .forgot-password {
            color: var(--gradient4);
            text-decoration: none;
            text-align: center;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--gradient3);
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

        .sign-in {
            margin-top: 24px;
        }

        .sign-in input[type="text"] {
            background: var(--background);
            text-align: center;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .sign-in input[type="text"]:hover {
            background: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .join-now {
            margin-top: 32px;
            text-align: center;
        }

        .join-now a {
            color: var(--gradient4);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .join-now a:hover {
            color: var(--gradient3);
            text-shadow: 0 0 15px rgba(241, 196, 15, 0.3);
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
                background: rgba(226, 251, 206, 0.15);  /* gradient2 with opacity */
                border-left: 4px solid var(--gradient2);
            }
            50% {
                background: rgba(227, 239, 38, 0.15);   /* gradient3 with opacity */
                border-left: 4px solid var(--gradient3);
            }
            100% {
                background: rgba(7, 102, 83, 0.15);     /* gradient4 with opacity */
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

        .login-btn {
            width: 100%;
            margin-top: 15px;
            background: linear-gradient(45deg, var(--gradient4), var(--gradient3));
        }

        .login-btn:hover i {
            transform: translateX(5px);
        }

        .login-btn:hover {
            background: linear-gradient(45deg, var(--gradient3), var(--gradient4));
            box-shadow: 0 5px 15px rgba(7, 102, 83, 0.3);
            transform: translateY(-2px);
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
        <div class="login">
            <form method="POST" action="">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Email or Phone" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <?php if (!empty($error)): ?>
                    <p style="color: red; text-align:center;"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>

                <button type="submit" class="btn login-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

                <a class="forgot-password" href="#">Forgot Password</a>

                <label>
                    <input type="checkbox" name="remember"> keep me logged in
                </label>

                <div class="hr-with-text">
                    <span>OR</span>
                </div>

                <p>By clicking Continue, you agree to Farmacy's 
                    <a href="#">User Agreement</a>, 
                    <a href="#">Privacy Policy</a>, and 
                    <a href="#">Cookie Policy</a>.
                </p>

                <div class="sign-in">
                    <div class="input-container social-signin google-signin">
                        <i class="fab fa-google"></i>
                        <input type="text" placeholder="Sign in with Google" readonly>
                    </div>
                    <div class="input-container social-signin apple-signin">
                        <i class="fab fa-apple"></i>
                        <input type="text" placeholder="Sign in with Apple" readonly>
                    </div>
                </div>
            </form>
        </div>
        <div class="join-now">
            <p>New to Farmacy? <a href="/signup.php">Join-now</a></p>
        </div>
    </div>
</body>
</html>
