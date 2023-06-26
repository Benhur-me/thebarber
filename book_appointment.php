<?php
// Retrieve the form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$hour = $_POST['hour'];

// Perform validation (you can add your own validation rules here)

// Connect to the database
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "barber";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  
}

// Check if the selected time and date are already booked
$stmt = $conn->prepare("SELECT * FROM appointments WHERE date = ? AND hour = ?");
$stmt->bind_param("ss", $date, $hour);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Appointment already exists for the selected time and date
    $successMessage = "<span class='warning-text'>Sorry, the selected time and date are not available. Please choose another slot.</span>";
} else {
    // Check if the phone number is already used for an appointment
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Phone number is already used for an appointment
        $successMessage = "<span class='warning-text'>Sorry, the phone number is already used for another appointment. Please provide a different phone number.</span>";
    } else {
        // The appointment is available, insert it into the database
        $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, date, hour) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $phone, $date, $hour);
        $result = $stmt->execute();

        if ($result) {
            $successMessage = "You have successfully made an appointment. Thank you!";
        } else {
            $successMessage = "Sorry, an error occurred while processing your appointment. Please try again.";
        }
    }
}

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
    <style>
        /* Add some styling to enhance the appearance */
        body {
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
        }

        .warning-text {
            color: red;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        p {
            text-align: center;
            font-size: 18px;
            margin-top: 30px;
        }

        .success-message {
            color: green;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Confirmation</h1>
        <p class="<?php echo ($result) ? 'success-message' : 'error-message'; ?>"><?php echo $successMessage; ?></p>
    </div>
</body>
</html>
