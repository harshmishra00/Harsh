<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pest_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$success_message = "";
$error_message = "";
$errors = array();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate first name
    if(empty($_POST['first_name'])) {
        $errors['first_name'] = "First name is required";
    } else if(!preg_match("/^[a-zA-Z ]*$/", $_POST['first_name'])) {
        $errors['first_name'] = "Only letters and spaces allowed";
    }

    // Validate last name  
    if(empty($_POST['last_name'])) {
        $errors['last_name'] = "Last name is required";
    } else if(!preg_match("/^[a-zA-Z ]*$/", $_POST['last_name'])) {
        $errors['last_name'] = "Only letters and spaces allowed";
    }

    // Validate email
    if(empty($_POST['email'])) {
        $errors['email'] = "Email is required";
    } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Validate phone
    if(empty($_POST['phone'])) {
        $errors['phone'] = "Phone number is required";
    } else if(!preg_match("/^[0-9]{10}$/", $_POST['phone'])) {
        $errors['phone'] = "Invalid phone number format (10 digits required)";
    }

    // Validate address
    if(empty($_POST['address'])) {
        $errors['address'] = "Address is required";
    }

    // Validate city
    if(empty($_POST['city'])) {
        $errors['city'] = "City is required";
    }

    // Validate state
    if(empty($_POST['state'])) {
        $errors['state'] = "State is required";
    }

    // Validate zip code
    if(empty($_POST['zip_code'])) {
        $errors['zip_code'] = "ZIP code is required";
    } else if(!preg_match("/^[0-9]{6}$/", $_POST['zip_code'])) {
        $errors['zip_code'] = "Invalid ZIP code (6 digits required)";
    }

    // Validate property type
    if(empty($_POST['property_type'])) {
        $errors['property_type'] = "Property type is required";
    }

    // Validate property size
    if(empty($_POST['property_size'])) {
        $errors['property_size'] = "Property size is required";
    }

    // Validate pest type
    if(empty($_POST['pest_type'])) {
        $errors['pest_type'] = "Pest type is required";
    }

    // Validate infestation level
    if(empty($_POST['infestation_level'])) {
        $errors['infestation_level'] = "Infestation level is required";
    }

    // Validate preferred time
    if(empty($_POST['preferred_time'])) {
        $errors['preferred_time'] = "Preferred time is required";
    }

    // If no validation errors, process the form
    if(empty($errors)) {
        // Sanitize input data
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $zip_code = mysqli_real_escape_string($conn, $_POST['zip_code']);
        $property_type = mysqli_real_escape_string($conn, $_POST['property_type']);
        $property_size = mysqli_real_escape_string($conn, $_POST['property_size']);
        $pest_type = mysqli_real_escape_string($conn, $_POST['pest_type']);
        $infestation_level = mysqli_real_escape_string($conn, $_POST['infestation_level']);
        $preferred_date = mysqli_real_escape_string($conn, $_POST['preferred_date']);
        $preferred_time = mysqli_real_escape_string($conn, $_POST['preferred_time']);
        $additional_notes = mysqli_real_escape_string($conn, $_POST['additional_notes']);
        $special_requirements = mysqli_real_escape_string($conn, $_POST['special_requirements']);
        $is_eco_friendly = isset($_POST['is_eco_friendly']) ? 1 : 0;
        $is_urgent = isset($_POST['is_urgent']) ? 1 : 0;

        // Prepare SQL statement
        $sql = "INSERT INTO pest_data (
            first_name, last_name, email, phone, address, city, state, zip_code, 
            property_type, property_size, pest_type, infestation_level, 
            preferred_date, preferred_time, additional_notes, special_requirements, 
            is_eco_friendly, is_urgent
        ) VALUES (
            '$first_name', '$last_name', '$email', '$phone', '$address', '$city', '$state', '$zip_code', 
            '$property_type', '$property_size', '$pest_type', '$infestation_level', 
            '$preferred_date', '$preferred_time', '$additional_notes', '$special_requirements', 
            $is_eco_friendly, $is_urgent
        )";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            $success_message = "Your pest control service request has been submitted successfully! We will contact you shortly.";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Pest Control Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary-color: #4CAF50;
            --secondary-color: #388E3C;
            --dark-color: #2E7D32;
            --light-color: #f4f4f4;
            --error-color: #f44336;
            --success-color: #4CAF50;
        }

        body {
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('https://www.gardentech.com/-/media/project/oneweb/gardentech/images/blog/what-is-integrated-pest-management/what-is-header.jpg') center/cover;
            color: white;
            text-align: center;
            padding: 3rem 1rem;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .header p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section h2 {
            color: var(--dark-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-color);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            flex: 1;
            min-width: 250px;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .checkbox-group input {
            margin-right: 0.5rem;
        }

        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 0 auto;
        }

        .submit-btn:hover {
            background-color: var(--secondary-color);
        }

        .message {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .success {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--success-color);
            border: 1px solid var(--success-color);
        }

        .error {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--error-color);
            border: 1px solid var(--error-color);
        }

        .required {
            color: var(--error-color);
            margin-left: 0.3rem;
        }

        .validation-error {
            color: var(--error-color);
            font-size: 0.9rem;
            margin-top: 0.2rem;
        }

        .footer {
            background: var(--dark-color);
            color: white;
            padding: 2rem 1rem;
            text-align: center;
            margin-top: 4rem;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
            
            .form-group {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Request Pest Control Service</h1>
        <p>Fill out the form below to request a quote for our pest control services. Our experts will contact you shortly.</p>
    </div>

    <div class="container">
        <?php if (!empty($success_message)): ?>
            <div class="message success">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="message error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-section">
                    <h2>Personal Information</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name <span class="required">*</span></label>
                            <?php if(isset($errors['first_name'])): ?>
                                <div class="validation-error"><?php echo $errors['first_name']; ?></div>
                            <?php endif; ?>
                            <input type="text" id="first_name" name="first_name" value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>" required>
                            <small>Only letters and spaces allowed</small>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name <span class="required">*</span></label>
                            <?php if(isset($errors['last_name'])): ?>
                                <div class="validation-error"><?php echo $errors['last_name']; ?></div>
                            <?php endif; ?>
                            <input type="text" id="last_name" name="last_name" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>" required>
                            <small>Only letters and spaces allowed</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <?php if(isset($errors['email'])): ?>
                                <div class="validation-error"><?php echo $errors['email']; ?></div>
                            <?php endif; ?>
                            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                            <small>Enter a valid email address</small>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number <span class="required">*</span></label>
                            <?php if(isset($errors['phone'])): ?>
                                <div class="validation-error"><?php echo $errors['phone']; ?></div>
                            <?php endif; ?>
                            <input type="tel" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" required>
                            <small>Enter 10 digit phone number</small>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2>Property Information</h2>
                    <div class="form-group">
                        <label for="address">Address <span class="required">*</span></label>
                        <?php if(isset($errors['address'])): ?>
                            <div class="validation-error"><?php echo $errors['address']; ?></div>
                        <?php endif; ?>
                        <input type="text" id="address" name="address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City <span class="required">*</span></label>
                            <?php if(isset($errors['city'])): ?>
                                <div class="validation-error"><?php echo $errors['city']; ?></div>
                            <?php endif; ?>
                            <input type="text" id="city" name="city" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State <span class="required">*</span></label>
                            <?php if(isset($errors['state'])): ?>
                                <div class="validation-error"><?php echo $errors['state']; ?></div>
                            <?php endif; ?>
                            <input type="text" id="state" name="state" value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="zip_code">ZIP Code <span class="required">*</span></label>
                            <?php if(isset($errors['zip_code'])): ?>
                                <div class="validation-error"><?php echo $errors['zip_code']; ?></div>
                            <?php endif; ?>
                            <input type="text" id="zip_code" name="zip_code" value="<?php echo isset($_POST['zip_code']) ? htmlspecialchars($_POST['zip_code']) : ''; ?>" required>
                            <small>Enter 6 digit ZIP code</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="property_type">Property Type <span class="required">*</span></label>
                            <?php if(isset($errors['property_type'])): ?>
                                <div class="validation-error"><?php echo $errors['property_type']; ?></div>
                            <?php endif; ?>
                            <select id="property_type" name="property_type" required>
                                <option value="">Select Property Type</option>
                                <option value="Residential" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'Residential') ? 'selected' : ''; ?>>Residential</option>
                                <option value="Commercial" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'Commercial') ? 'selected' : ''; ?>>Commercial</option>
                                <option value="Industrial" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'Industrial') ? 'selected' : ''; ?>>Industrial</option>
                                <option value="Other" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="property_size">Property Size <span class="required">*</span></label>
                            <?php if(isset($errors['property_size'])): ?>
                                <div class="validation-error"><?php echo $errors['property_size']; ?></div>
                            <?php endif; ?>
                            <input type="text" id="property_size" name="property_size" placeholder="e.g., 1500 sq ft, 2 acres" value="<?php echo isset($_POST['property_size']) ? htmlspecialchars($_POST['property_size']) : ''; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2>Pest Information</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pest_type">Type of Pest <span class="required">*</span></label>
                            <?php if(isset($errors['pest_type'])): ?>
                                <div class="validation-error"><?php echo $errors['pest_type']; ?></div>
                            <?php endif; ?>
                            <select id="pest_type" name="pest_type" required>
                                <option value="">Select Pest Type</option>
                                <option value="Termites" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Termites') ? 'selected' : ''; ?>>Termites</option>
                                <option value="Mosquitoes" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Mosquitoes') ? 'selected' : ''; ?>>Mosquitoes</option>
                                <option value="Cockroaches" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Cockroaches') ? 'selected' : ''; ?>>Cockroaches</option>
                                <option value="Rats" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Rats') ? 'selected' : ''; ?>>Rats</option>
                                <option value="Lizards" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Lizards') ? 'selected' : ''; ?>>Lizards</option>
                                <option value="Ants" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Ants') ? 'selected' : ''; ?>>Ants</option>
                                <option value="Bed Bugs" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Bed Bugs') ? 'selected' : ''; ?>>Bed Bugs</option>
                                <option value="Rodents" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Rodents') ? 'selected' : ''; ?>>Rodents</option>
                                <option value="Multiple" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Multiple') ? 'selected' : ''; ?>>Multiple Types</option>
                                <option value="Other" <?php echo (isset($_POST['pest_type']) && $_POST['pest_type'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="infestation_level">Infestation Level <span class="required">*</span></label>
                            <?php if(isset($errors['infestation_level'])): ?>
                                <div class="validation-error"><?php echo $errors['infestation_level']; ?></div>
                            <?php endif; ?>
                            <select id="infestation_level" name="infestation_level" required>
                                <option value="">Select Infestation Level</option>
                                <option value="Low" <?php echo (isset($_POST['infestation_level']) && $_POST['infestation_level'] == 'Low') ? 'selected' : ''; ?>>Low</option>
                                <option value="Medium" <?php echo (isset($_POST['infestation_level']) && $_POST['infestation_level'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                                <option value="High" <?php echo (isset($_POST['infestation_level']) && $_POST['infestation_level'] == 'High') ? 'selected' : ''; ?>>High</option>
                                <option value="Unknown" <?php echo (isset($_POST['infestation_level']) && $_POST['infestation_level'] == 'Unknown') ? 'selected' : ''; ?>>Unknown</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="additional_notes">Additional Notes</label>
                        <textarea id="additional_notes" name="additional_notes" placeholder="Please provide any additional information about the pest problem..."><?php echo isset($_POST['additional_notes']) ? htmlspecialchars($_POST['additional_notes']) : ''; ?></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <h2>Service Preferences</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="preferred_date">Preferred Service Date</label>
                            <input type="date" id="preferred_date" name="preferred_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo isset($_POST['preferred_date']) ? htmlspecialchars($_POST['preferred_date']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="preferred_time">Preferred Service Time <span class="required">*</span></label>
                            <?php if(isset($errors['preferred_time'])): ?>
                                <div class="validation-error"><?php echo $errors['preferred_time']; ?></div>
                            <?php endif; ?>
                            <select id="preferred_time" name="preferred_time" required>
                                <option value="">Select Preferred Time</option>
                                <option value="Morning" <?php echo (isset($_POST['preferred_time']) && $_POST['preferred_time'] == 'Morning') ? 'selected' : ''; ?>>Morning (8AM - 12PM)</option>
                                <option value="Afternoon" <?php echo (isset($_POST['preferred_time']) && $_POST['preferred_time'] == 'Afternoon') ? 'selected' : ''; ?>>Afternoon (12PM - 4PM)</option>
                                <option value="Evening" <?php echo (isset($_POST['preferred_time']) && $_POST['preferred_time'] == 'Evening') ? 'selected' : ''; ?>>Evening (4PM - 8PM)</option>
                                <option value="Any" <?php echo (isset($_POST['preferred_time']) && $_POST['preferred_time'] == 'Any') ? 'selected' : ''; ?>>Any Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="special_requirements">Special Requirements</label>
                        <textarea id="special_requirements" name="special_requirements" placeholder="Any special requirements or instructions for our service..."><?php echo isset($_POST['special_requirements']) ? htmlspecialchars($_POST['special_requirements']) : ''; ?></textarea>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_eco_friendly" name="is_eco_friendly" <?php echo (isset($_POST['is_eco_friendly'])) ? 'checked' : ''; ?>>
                        <label for="is_eco_friendly">I prefer eco-friendly pest control solutions</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_urgent" name="is_urgent" <?php echo (isset($_POST['is_urgent'])) ? 'checked' : ''; ?>>
                        <label for="is_urgent">This is an urgent request</label>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Submit Request</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>Contact us: 9911918545 | email@example.com</p>
        <p>© 2023 GPC. All rights reserved</p>
    </footer>

    <script>
        // Set minimum date for date picker to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('preferred_date').min = today;
        });
    </script>
</body>
</html>