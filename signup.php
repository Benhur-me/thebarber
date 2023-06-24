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

         <style>
      /* Additional custom styles */
    
      .navbar {
         background-color: #f1f1f1;
      }
      .login-box {
         max-width: 400px;
         margin: 0 auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         margin-top: 60px;
      }

      .login-box h1 {
         font-family: "Poppins", sans-serif;
         font-size: 24px;
         margin-bottom: 20px;
         text-align: center;
         color: #333;
      }

      .login-box label {
         font-family: "Poppins", sans-serif;
         font-size: 14px;
         font-weight: bold;
         color: #555;
      }

      .login-box input[type="email"],
      .login-box input[type="password"] {
         width: 100%;
         padding: 10px;
         margin-bottom: 20px;
         border: 1px solid #ddd;
         border-radius: 3px;
         font-family: "Poppins", sans-serif;
         font-size: 14px;
         color: #555;
      }

      .login-box input[type="submit"] {
         width: 100%;
         padding: 12px 20px;
         background-color: #0077cc;
         border: none;
         border-radius: 3px;
         font-family: "Poppins", sans-serif;
         font-size: 16px;
         font-weight: bold;
         color: #fff;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }

      .login-box input[type="submit"]:hover {
         background-color: #005ea6;
      }

      .login-box a {
         display: block;
         text-align: center;
         font-family: "Poppins", sans-serif;
         font-size: 14px;
         color: #555;
         text-decoration: none;
      }

      .login-box a:hover {
         text-decoration: underline;
      }

      /* Responsive styles */
      @media only screen and (max-width: 600px) {
         .login-box {
            padding: 15px;
            margin-top: 100px;
            width: 100%;
         }
         .login-box h1 {
            font-size: 20px;
         }
         .login-box input[type="email"],
         .login-box input[type="password"],
         .login-box input[type="submit"] {
            font-size: 12px;
         }
      }
      
   </style>
</head>

<body class="w3-sand">

<!-- Navbar Section -->
<div class="w3-top navbar">
    <div class="w3-row w3-padding">
        <div class="w3-col s12">
            <div class="w3-bar w3-center">
                <div class="w3-bar-item w3-left">
                    <a href="#" class="w3-button">
                        <i class="fas fa-cut"></i>
                    </a>
                </div>
                <!-- Hamburger icon visible on small screens -->
                <div class="w3-bar-item w3-right w3-hide-medium w3-hide-large">
                    <button onclick="toggleMenu()" class="w3-button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <!-- Navigation menus visible on medium and large screens -->
                <div class="w3-col m3 w3-hide-small w3-inline-block">
                    <a href="#home" class="w3-button w3-b w3-block">Home</a>
                </div>
                <div class="w3-col m3 w3-hide-small w3-inline-block">
                    <a href="#hour-section" class="w3-button w3-b w3-block">Opening hours</a>
                </div>
                <div class="w3-col m3 w3-hide-small w3-inline-block">
                    <a href="#price-section" class="w3-button w3-b w3-block">Prices</a>
                </div>
            </div>
            <!-- Responsive menu -->
            <!-- Responsive menu -->
            <div id="responsiveMenu" class="w3-hide w3-hide-medium w3-hide-large">
            <div class="w3-col s12">
                <a href="#home" class="w3-button w3-b w3-block">Home</a>
            </div>
            <div class="w3-col s12">
                <a href="#hour-section" class="w3-button w3-b w3-block">Opening hours</a>
            </div>
            <div class="w3-col s12">
                <a href="#price-section" class="w3-button w3-b w3-block">Prices</a>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>


<script>
    function toggleMenu() {
        var menu = document.getElementById("menu");
        if (menu.style.display === "block") {
            menu.style.display = "none";
        } else {
            menu.style.display = "block";
        }
    }

    function toggleMenu() {
        var menu = document.getElementById("responsiveMenu");
        menu.classList.toggle("w3-hide");
    }

    function toggleMenu() {
        var menu = document.getElementById("responsiveMenu");
        menu.classList.toggle("w3-hide");
    }
</script>


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
