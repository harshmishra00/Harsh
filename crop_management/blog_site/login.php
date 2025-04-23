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

        /* Forgot Password Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: var(--background);
            margin: 10% auto;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            position: relative;
            animation: slideIn 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 24px;
            cursor: pointer;
            color: var(--text);
            transition: transform 0.3s ease;
        }

        .close-modal:hover {
            transform: rotate(90deg);
        }

        .steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gradient4);
            z-index: 1;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--background);
            border: 2px solid var(--gradient4);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .step.active {
            background: var(--gradient4);
            color: white;
        }

        .step.completed {
            background: var(--gradient3);
            border-color: var(--gradient3);
            color: white;
        }

        .step-text {
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            font-size: 12px;
            color: var(--text);
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        .success-message {
            text-align: center;
            padding: 20px;
            color: var(--gradient4);
            display: none;
        }

        .success-message i {
            font-size: 48px;
            margin-bottom: 20px;
            color: var(--gradient3);
        }

        /* Enhanced Email Input Styles */
        .email-input-container {
            position: relative;
            margin-bottom: 20px;
        }

        .email-input-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text);
            font-size: 19px;
            transition: all 0.3s ease;
        }

        .email-input-container input[type="email"] {
            width: 100%;
            padding: 15px 45px;
            border: 2px solid #e1e1e1;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: var(--background);
        }

        .email-input-container input[type="email"]:focus {
            outline: none;
            border-color: var(--gradient4);
            box-shadow: 0 0 15px rgba(7, 102, 83, 0.2);
            transform: scale(1.01);
        }

        .email-input-container input[type="email"]:focus + i {
            color: var(--gradient4);
            transform: translateY(-50%) scale(1.1);
        }

        .email-input-container .error-message {
            display: none;
            color: #ff4444;
            font-size: 14px;
            margin-top: 5px;
            padding-left: 45px;
        }

        .email-input-container .success-message {
            display: none;
            color: var(--gradient4);
            font-size: 14px;
            margin-top: 5px;
            padding-left: 45px;
        }

        .email-input-container .hint-text {
            display: block;
            color: #666;
            font-size: 12px;
            margin-top: 5px;
            padding-left: 45px;
        }

        /* Loading Animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-spinner {
            display: none;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 3px solid rgba(7, 102, 83, 0.1);
            border-top-color: var(--gradient4);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Enhanced Button Styles */
        .send-otp-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, var(--gradient4), var(--gradient3));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .send-otp-btn:hover {
        }

        /* Enhanced Email Input Styles for Modal */
        .modal-email-input {
            position: relative;
            margin: 25px 0;
        }

        .modal-email-input i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gradient4);
            font-size: 20px;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .modal-email-input input[type="email"] {
            width: 100%;
            padding: 18px 55px;
            border: 2px solid #e1e1e1;
            border-radius: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .modal-email-input input[type="email"]:focus {
            outline: none;
            border-color: var(--gradient4);
            box-shadow: 0 0 20px rgba(7, 102, 83, 0.15);
            transform: translateY(-2px);
            background-color: white;
        }

        .modal-email-input input[type="email"]:focus + i {
            color: var(--gradient3);
            transform: translateY(-50%) scale(1.1);
        }

        .modal-email-input .input-label {
            position: absolute;
            left: 55px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 16px;
            transition: all 0.3s ease;
            pointer-events: none;
            background: transparent;
            padding: 0 5px;
        }

        .modal-email-input input[type="email"]:focus + i + .input-label,
        .modal-email-input input[type="email"]:not(:placeholder-shown) + i + .input-label {
            top: 0;
            transform: translateY(-50%) scale(0.9);
            color: var(--gradient4);
            background: white;
        }

        .modal-email-input .error-message {
            display: none;
            color: #ff4444;
            font-size: 14px;
            margin-top: 8px;
            padding-left: 20px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .modal-email-input .success-message {
            display: none;
            color: var(--gradient4);
            font-size: 14px;
            margin-top: 8px;
            padding-left: 20px;
        }

        .modal-email-input .hint-text {
            display: block;
            color: #666;
            font-size: 13px;
            margin-top: 8px;
            padding-left: 20px;
            font-style: italic;
        }

        /* Enhanced Modal Button Styles */
        .modal-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(45deg, var(--gradient4), var(--gradient3));
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
            box-shadow: 0 4px 15px rgba(7, 102, 83, 0.2);
        }

        .modal-btn:hover {
            background: linear-gradient(45deg, var(--gradient3), var(--gradient4));
            box-shadow: 0 6px 20px rgba(7, 102, 83, 0.3);
            transform: translateY(-2px);
        }

        .modal-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .modal-btn i {
            transition: transform 0.3s ease;
        }

        .modal-btn:hover i {
            transform: translateX(5px);
        }

        /* Loading Animation for Modal */
        .modal-loading {
            display: none;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 3px solid rgba(7, 102, 83, 0.1);
            border-top-color: var(--gradient4);
            border-radius: 50%;
            animation: spin 1s linear infinite;
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
            <h2>Welcome Back</h2>
            <?php if($error): ?>
                <div class="error" style="color: red; margin-bottom: 15px;"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Email or Phone" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn login-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <a class="forgot-password" href="#" onclick="showForgotPasswordModal()">Forgot Password</a>
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
            <div class="join-now">
                <p>New to Farmacy? <a href="signup.php">Join-now</a></p>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeForgotPasswordModal()">&times;</span>
            <h2>Reset Your Password</h2>
            
            <div class="steps">
                <div class="step active" id="step1">
                    <i class="fas fa-envelope"></i>
                    <span class="step-text">Email</span>
                </div>
                <div class="step" id="step2">
                    <i class="fas fa-shield-alt"></i>
                    <span class="step-text">Verify</span>
                </div>
                <div class="step" id="step3">
                    <i class="fas fa-key"></i>
                    <span class="step-text">Reset</span>
                </div>
            </div>

            <div class="step-content active" id="step1-content">
                <div class="modal-email-input">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="resetEmail" placeholder=" " required>
                    <span class="input-label">Enter your email address</span>
                    <div class="modal-loading"></div>
                    <div class="error-message"></div>
                    <div class="success-message"></div>
                    <span class="hint-text">We'll send a verification code to this email</span>
                </div>
                <button class="modal-btn" onclick="sendResetOTP()">
                    <i class="fas fa-paper-plane"></i>
                    Send Verification Code
                </button>
            </div>

            <div class="step-content" id="step2-content">
                <div class="input-container">
                    <i class="fas fa-shield-alt"></i>
                    <input type="text" id="resetOTP" placeholder="Enter verification code" required>
                </div>
                <button class="btn" onclick="verifyOTP()">Verify Code</button>
            </div>

            <div class="step-content" id="step3-content">
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="newPassword" placeholder="New password" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="confirmNewPassword" placeholder="Confirm new password" required>
                </div>
                <button class="btn" onclick="resetPassword()">Reset Password</button>
            </div>

            <div class="success-message" id="successMessage">
                <i class="fas fa-check-circle"></i>
                <h3>Password Reset Successful!</h3>
                <p>Your password has been reset successfully. You can now login with your new password.</p>
            </div>
        </div>
    </div>

    <script>
        function showForgotPasswordModal() {
            document.getElementById('forgotPasswordModal').style.display = 'block';
        }

        function closeForgotPasswordModal() {
            document.getElementById('forgotPasswordModal').style.display = 'none';
            resetSteps();
        }

        function resetSteps() {
            document.querySelectorAll('.step').forEach(step => {
                step.classList.remove('active', 'completed');
            });
            document.querySelectorAll('.step-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById('step1').classList.add('active');
            document.getElementById('step1-content').classList.add('active');
            document.getElementById('successMessage').style.display = 'none';
        }

        function sendResetOTP() {
            const email = document.getElementById('resetEmail').value;
            if (!email) {
                alert('Please enter your email address');
                return;
            }

            // Show loading state
            const button = document.querySelector('#step1-content .btn');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            button.disabled = true;

            // Send email via AJAX
            fetch('send_reset_email.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(email)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Move to next step
                    document.getElementById('step1').classList.add('completed');
                    document.getElementById('step2').classList.add('active');
                    document.getElementById('step1-content').classList.remove('active');
                    document.getElementById('step2-content').classList.add('active');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('An error occurred. Please try again.');
            })
            .finally(() => {
                // Reset button state
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }

        function verifyOTP() {
            const email = document.getElementById('resetEmail').value;
            const otp = document.getElementById('resetOTP').value;
            if (!otp) {
                alert('Please enter the verification code');
                return;
            }

            // Show loading state
            const button = document.querySelector('#step2-content .btn');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';
            button.disabled = true;

            // Verify OTP via AJAX
            fetch('verify_otp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(email)}&otp=${encodeURIComponent(otp)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('step2').classList.add('completed');
                    document.getElementById('step3').classList.add('active');
                    document.getElementById('step2-content').classList.remove('active');
                    document.getElementById('step3-content').classList.add('active');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('An error occurred. Please try again.');
            })
            .finally(() => {
                // Reset button state
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }

        function resetPassword() {
            const email = document.getElementById('resetEmail').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmNewPassword').value;

            if (!newPassword || !confirmPassword) {
                alert('Please enter and confirm your new password');
                return;
            }

            if (newPassword !== confirmPassword) {
                alert('Passwords do not match');
                return;
            }

            // Show loading state
            const button = document.querySelector('#step3-content .btn');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Resetting...';
            button.disabled = true;

            // Reset password via AJAX
            fetch('reset_password.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(newPassword)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('step3').classList.add('completed');
                    document.getElementById('step3-content').classList.remove('active');
                    document.getElementById('successMessage').style.display = 'block';

                    // Close modal after 3 seconds
                    setTimeout(() => {
                        closeForgotPasswordModal();
                    }, 3000);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('An error occurred. Please try again.');
            })
            .finally(() => {
                // Reset button state
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('forgotPasswordModal')) {
                closeForgotPasswordModal();
            }
        }
    </script>
</body>
</html>
