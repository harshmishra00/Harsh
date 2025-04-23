<?php
require 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Check if email exists in database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($result) === 0) {
        echo json_encode(['success' => false, 'message' => 'No account found with this email']);
        exit();
    }

    // Generate 6-digit OTP
    $otp = rand(100000, 999999);
    
    // Store OTP in database with expiration time (5 minutes)
    $expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));
    mysqli_query($conn, "UPDATE users SET reset_otp='$otp', reset_otp_expiry='$expiry' WHERE email='$email'");

    // Send email using PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  // Your email
        $mail->Password = 'your-app-password';     // Your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Farmacy');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset OTP';
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #076653;'>Password Reset Request</h2>
                <p>Hello,</p>
                <p>You have requested to reset your password. Please use the following OTP to proceed:</p>
                <div style='background: #E2FBCE; padding: 20px; text-align: center; margin: 20px 0;'>
                    <h1 style='color: #076653; margin: 0; letter-spacing: 5px;'>$otp</h1>
                </div>
                <p>This OTP will expire in 5 minutes.</p>
                <p>If you didn't request this, please ignore this email.</p>
                <p>Best regards,<br>Farmacy Team</p>
            </div>
        ";

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'OTP sent successfully']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Failed to send OTP. Please try again.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 