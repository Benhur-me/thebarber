<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email = $_POST["name"]; // Renamed the variable to $email
   $password = $_POST["password"];
   $confirmPassword = $_POST["confirm_password"];

   // Perform further validation and error checking
   if ($password !== $confirmPassword) {
       $error = "Passwords do not match";
   } else {
       // Establish a connection to the MySQL database
       $servername = "localhost";
       $dbUsername = "root";
       $dbPassword = "";
       $dbName = "barber";

       $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }

       // Check if the email already exists in the database
       $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
       $result = $conn->query($checkEmailQuery);

       if ($result->num_rows > 0) {
           $error = "Email already taken";
       } else {
           // Insert user credentials into the "users" table
           $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

           $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')"; // Updated the column name

           if ($conn->query($sql) === TRUE) {
               $confirmation = "Account created successfully!";
           } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
           }
       }

       $conn->close();
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Barber Website</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <!-- Custom Css -->
   <link rel="stylesheet" href="style.css">
   <!-- Font Families -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
         integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body class="w3-sand">

<!-- Navbar Section -->
<div class="w3-top">
    <div class="w3-row w3-padding w3-light-gray">
        <div class="w3-col s2">
            <a href="#" class="w3-button w3-block">
                <i class="fas fa-cut"></i>
            </a>
        </div>
        <div class="w3-col s2">
            <a href="" class="w3-button w3-b w3-block">Home</a>
        </div>
        <div class="w3-col s2">
            <a href="" class="w3-button w3-b w3-block">Opening hours</a>
        </div>
        <div class="w3-col s2">
            <a href="" class="w3-button w3-b w3-block">Prices</a>
        </div>
        <div class="w3-col s2">
            <a href="login.php" class="w3-button w3-b w3-block">Login/Register</a>
        </div>
        
</div>

<!-- Signup form HTML -->
<div style="margin-top: 60px;" class="signup-box">
    <h1>Sign Up</h1>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <?php if (isset($confirmation)) { ?>
        <p style="color: green;"><?php echo $confirmation; ?></p>
    <?php } ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="name">Email:</label>
        <input type="email" id="name" name="name" required> <!-- Updated the input field name -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <input type="submit" value="Submit"><br>

        <button style="padding:5px; width: 50px; margin:0 auto; "><a style="text-decoration: none" href="login.php">Login</a></button>
    </form>
</div>
</body>
</html>
