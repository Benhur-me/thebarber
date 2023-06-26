<!DOCTYPE html>
<html>
<head>
    <title>Appointment Dashboard</title>
    <style>
        /* Add some styling to enhance the appearance */
        .w3-center {
            text-align: center;
        }

        .w3-padding-48 {
            padding: 48px;
        }

        .w3-tag {
            background-color: #f1f1f1;
            padding: 5px;
        }

        .w3-wide {
            font-weight: bold;
        }

        .section-break {
            border-top: 1px solid #ccc;
            margin: 24px 0;
            padding-top: 24px;
        }

        .w3-sand {
            background-color: #fdf5e6;
        }

        .w3-table {
            width: 100%;
            border-collapse: collapse;
        }

        .w3-table th, .w3-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .w3-table th {
            background-color: #f2f2f2;
        }

        .w3-blue {
            background-color: #007bff;
            color: #000;
        }
    </style>
</head>
<body>
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">APPOINTMENT DASHBOARD</span></h5>
    <div class="w3-container w3-center w3-padding-48 w3-large section-break w3-sand">
        <h4>Appointment Dashboard</h4>

        <?php
        session_start();

        if ($_SESSION['email'] != "Admin@yahoo.com") {
            header("Location: home.php"); // Redirect to the login page
            exit();
        }

        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "barber";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle delete request
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_appointment'])) {
            $appointmentId = $_POST['delete_appointment'];

            // Delete the appointment from the database
            $query = "DELETE FROM appointments WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $appointmentId);

            if ($stmt->execute()) {
                echo "Appointment deleted successfully.";
            } else {
                echo "Failed to delete the appointment.";
            }

            $stmt->close();
        }

        // Fetch appointments from the database
        $query = "SELECT * FROM appointments";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table class='w3-table'>";
            echo "<tr class='w3-blue'>";
            echo "<th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Phone</th>";
            echo "<th>Date</th>";
            echo "<th>Hour</th>";
            echo "<th>Action</th>";
            echo "</tr>";
       
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['hour'] . "</td>";
                echo "<td>";
                echo "<form method='post' onsubmit='return confirm(\"Are you sure you want to delete this appointment?\");'>";
                echo "<input type='hidden' name='delete_appointment' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='submit_" . $row['id'] . "' value='" . $row['id'] . "'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            
            // Process form submissions
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_appointment'])) {
                $appointmentId = $_POST['delete_appointment'];
            
                // Delete the appointment from the database
                $query = "DELETE FROM appointments WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $appointmentId);
            
                if ($stmt->execute()) {
                    echo "";
                } else {
                    echo "Failed to delete the appointment.";
                }
            
                $stmt->close();
            }
            
        }
        ?>
    </div>
</body>
</html>
