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

// Prepare and execute the SQL statement to insert the appointment into the database
$stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, date, hour) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $date, $hour);

// Execute the SQL statement
$result = $stmt->execute();

// Check if the appointment was successfully booked
if ($result) {
    $successMessage = "You have successfully made an appointment. Thank you!";
} else {
    $successMessage = "Sorry, an error occurred while processing your appointment. Please try again.";
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
        <?php if ($result) { ?>
            <p class="success-message"><?php echo $successMessage; ?></p>
        <?php } else { ?>
            <p class="error-message"><?php echo $successMessage; ?></p>
        <?php } ?>
    </div>
</body>
</html>
