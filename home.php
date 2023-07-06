<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to the login page
    exit();
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy all session data
    header("Location: login.php"); // Redirect to the login page after logout
    exit();
}

// Get the email from the session
$email = $_SESSION["email"];

// Define an array of barbers with their phone numbers and emails
$barbers = array(
    array(
        "name" => "Michael",
        "phone" => "+256-700-282-652",
        "email" => "michaelbarber@gmail.com"
    ),
    array(
        "name" => "Sandra",
        "phone" => "+256-735-467-347",
        "email" => "sandrabarber@yahoo.com"
    ),
    array(
        "name" => "Caleb",
        "phone" => "+256-783-456-271",
        "email" => "calebbarber@gmail.com"
    )
);
?>


<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        .rating {
            margin: 0
            display: flex;
            flex-wrap: nowrap; /* Ensure the rating stars stay in a single line */
            overflow-x: auto; /* Enable horizontal scrolling for rating stars if needed */
        }

        .rating input[type="radio"],
        .rating label {
        flex-shrink: 0; /* Prevent the rating stars from shrinking */
        }

        /* Top Navigation */
        .w3-top {
            position: fixed;
            width: 100%;
        }

        .w3-row.w3-padding.w3-light-gray {
            background-color: #000;
        }

        .w3-col.s2 {
            width: 16.66%;
            padding: 10px 0;
        }

        .w3-button.w3-block {
            display: block;
            width: 100%;
            text-align: center;
            border: none;
            outline: none;
            background-color: inherit;
            color: #000;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .w3-button.w3-block:hover {
            background-color: #ddd;
        }

        /* Welcome Section */
        .login-box {
            margin-top: 60px;
            text-align: center;
            padding: 20px;
        }

        /* Slideshow */
        .w3-container.w3-center.w3-padding-64 {
            position: relative;
        }

        .w3-content.w3-display-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .w3-image {
            width: 100%;
            max-width: 1000px;
            transition: filter 0.3s;
        }

        .w3-button.w3-black.w3-display-left,
        .w3-button.w3-black.w3-display-right {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            padding: 16px;
        }

        .w3-button.w3-black.w3-display-left:hover,
        .w3-button.w3-black.w3-display-right:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .dark-image {
            filter: brightness(50%); /* Adjust the brightness value as desired */
        }

        .login-box {
       
        text-align: center;
        background-color: #f2f2f2;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .login-box h1 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .login-box p {
        font-size: 18px;
        color: #777;
    }


          /* Styles for small screens */
    @media (max-width: 767px) {
        .login-box {
            margin-top: 30px;
            padding: 15px;
        }

        .login-box h1 {
            font-size: 20px;
        }

        .login-box p {
            font-size: 16px;
        }
    }
        

        
    </style>

<head>
    <title>Barber Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <!-- Font Families -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
        <!-- Hamburger icon visible on small screens -->
        <div class="w3-col s2 w3-hide-medium w3-hide-large">
            <a href="#" class="w3-button w3-block" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </a>
        </div>
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
            <div class="w3-col s12">
                <a href="#appointment-section" class="w3-button w3-b w3-block">Book</a>
            </div>
            <div class="w3-col s12">
                <form method="POST" action="">
                    <button type="submit" name="logout" class="w3-button w3-b w3-block">
                        <img src="logout2.png" alt="logout icon">
                    </button>
                </form>
            </div>
        </div>
        <!-- Navigation menus visible on medium and large screens -->
        <div class="w3-col m2 l2 w3-hide-small">
            <a href="#home" class="w3-button w3-b w3-block">Home</a>
        </div>
        <div class="w3-col m2 l2 w3-hide-small">
            <a href="#hour-section" class="w3-button w3-b w3-block">Opening hours</a>
        </div>
        <div class="w3-col m2 l2 w3-hide-small">
            <a href="#price-section" class="w3-button w3-b w3-block">Prices</a>
        </div>
        <div class="w3-col m2 l2 w3-hide-small">
            <a href="#appointment-section" class="w3-button w3-b w3-block">Book</a>
        </div>
        <div class="w3-col m2 l2 w3-hide-small">
            <form method="POST" action="">
                <button type="submit" name="logout" class="w3-button w3-b w3-block">
                    <img src="logout2.png" alt="logout icon">
                </button>
            </form>
        </div>
    </div>
</div>




<!-- To welcoming the user -->
<div class="login-box" style=" margin-top: 90px;">
    <h1>Welcome, <?php echo $email; ?>!</h1>
    <p>You have successfully logged in.</p>
</div>

<!-- Image Section -->

<!-- Slides -->
<div id="home" class="w3-container w3-center w3-padding-64">
    <div class="w3-content w3-display-container">
        <img src="barber1.webp" alt="Slide 1" class="w3-image dark-image" style="width:100%; max-width:1000px; transition: filter 0.3s;">
        <img src="barber2.webp" alt="Slide 2" class="w3-image dark-image" style="width:100%; max-width:1000px; transition: filter 0.3s;">
        <img src="barber3.avif" alt="Slide 3" class="w3-image dark-image" style="width:100%; max-width:1000px; transition: filter 0.3s;">

        <!-- Navigation arrows -->
        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>
</div>

<!-- OUR BARBERS SECTION -->
<div class="w3-sand w3-large" id="information">
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">OUR BARBERS</span></h5>
    <div class="w3-row-padding w3-padding-large">
    <div class="w3-third w3-container w3-margin-bottom w3-hover-grayscale">
    <div class="w3-container w3-center w3-black">
        <div style="height: 100%; max-width: 170px; margin: 0 auto; padding: 2rem;">
            <img src="https://images.unsplash.com/photo-1578176603894-57973e38890f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=580&q=80" class="w3-circle" alt="barber" style="width: 100%; height: 100%;">
        </div>
        <form id="michael_rating_form" action="rating.php" method="post">
            <p><b>Michael</b> (owner)</p>
            <p>Phone: <?php echo $barbers[0]['phone']; ?></p>
            <p>Email: <?php echo $barbers[0]['email']; ?></p>
            <div class="rating">
    <input type="radio" id="michael_star5" name="michael_rating" value="5" required>
    <label for="michael_star5" title="5 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="michael_star4" name="michael_rating" value="4">
    <label for="michael_star4" title="4 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="michael_star3" name="michael_rating" value="3">
    <label for="michael_star3" title="3 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="michael_star2" name="michael_rating" value="2">
    <label for="michael_star2" title="2 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="michael_star1" name="michael_rating" value="1">
    <label for="michael_star1" title="1 star"><i class="fas fa-star"></i></label>
</div>
<p id="michael-average-rating" style="font-size: 14px; color: #888; margin-top: 5px;">Average rating: 0 stars</p>


            <button type="submit" style="background-color: #4CAF50; color: white; border: none; padding: 8px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-top: 1rem; cursor: pointer; border-radius: 4px;">Submit</button>
            <div id="michael_rating_summary"></div>
        </form>
    </div>
</div>]
<div class="w3-third w3-container w3-margin-bottom w3-hover-grayscale">
    <div class="w3-container w3-center w3-black">
        <div style="height: 100%; max-width: 170px; margin: 0 auto; padding: 2rem;">
        <img src="https://images.unsplash.com/photo-1578176603894-57973e38890f?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=580&q=80" class="w3-circle" alt="barber" style="width: 100%; height: 100%;">
        </div>
        <form id="sandra_rating_form" action="rating.php" method="post">
            <p><b>Sandra</b></p>
            <p>Phone: <?php echo $barbers[1]['phone']; ?></p>
            <p>Email: <?php echo $barbers[1]['email']; ?></p>
            <div class="rating">
    <input type="radio" id="sandra_star5" name="sandra_rating" value="5" required>
    <label for="sandra_star5" title="5 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="sandra_star4" name="sandra_rating" value="4">
    <label for="sandra_star4" title="4 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="sandra_star3" name="sandra_rating" value="3">
    <label for="sandra_star3" title="3 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="sandra_star2" name="sandra_rating" value="2">
    <label for="sandra_star2" title="2 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="sandra_star1" name="sandra_rating" value="1">
    <label for="sandra_star1" title="1 star"><i class="fas fa-star"></i></label>
</div>
<p id="sandra-average-rating" style="font-size: 14px; color: #888; margin-top: 5px;">Average rating: 0 stars</p>



            <button type="submit" style="background-color: #4CAF50; color: white; border: none; padding: 8px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-top: 1rem; cursor: pointer; border-radius: 4px;">Submit</button>
        </form>
    </div>
</div>

<div class="w3-third w3-container w3-margin-bottom w3-hover-grayscale">
    <div class="w3-container w3-center w3-black">
        <div style="height: 100%; max-width: 170px; margin: 0 auto; padding: 2rem;">
            <img src="https://images.unsplash.com/photo-1595152452543-e5fc28ebc2b8?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=580&q=80" class="w3-circle" alt="barber" style="width: 100%; height: 100%;">
        </div>
        <form id="caleb_rating_form" action="rating.php" method="post">
            <p><b>Caleb</b></p>
            <p>Phone: <?php echo $barbers[2]['phone']; ?></p>
            <p>Email: <?php echo $barbers[2]['email']; ?></p>
            <div class="rating">
    <input type="radio" id="caleb_star5" name="caleb_rating" value="5" required>
    <label for="caleb_star5" title="5 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="caleb_star4" name="caleb_rating" value="4">
    <label for="caleb_star4" title="4 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="caleb_star3" name="caleb_rating" value="3">
    <label for="caleb_star3" title="3 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="caleb_star2" name="caleb_rating" value="2">
    <label for="caleb_star2" title="2 stars"><i class="fas fa-star"></i></label>
    <input type="radio" id="caleb_star1" name="caleb_rating" value="1">
    <label for="caleb_star1" title="1 star"><i class="fas fa-star"></i></label>
</div>
<p id="caleb-average-rating" style="font-size: 14px; color: #888; margin-top: 5px;">Average rating: 0 stars</p>



            <button type="submit" style="background-color: #4CAF50; color: white; border: none; padding: 8px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin-top: 1rem; cursor: pointer; border-radius: 4px;">Submit</button>
        </form>
    </div>
</div>

</div>

    </div>
</div>

<!-- Barber Shop Information Section -->
<h5 class="w3-center w3-padding-48" id="hour-section"><span class="w3-tag w3-wide">SHOP INFORMATION</span></h5>
<div class="w3-center">
    <div class="w3-container w3-padding-48 w3-large section-break w3-sand" id="information">
        <div class="w3-third w3-center w3-container w3-margin-bottom">
            <div class="w3-padding-64">
                <i class="fas fa-map-marker fa-5x"></i>
                <p style="color: #fff">Shop location</p>
            </div>
            <div class="w3-container w3-black" style="height: 180px;">
                <p><b>ቦታ (Location)</b></p>
                <p>ካቡሱ ፊሽ ማርኬት ( kabusu fish Market)</p>
            </div>
        </div>
        <div class="w3-third w3-center w3-container w3-margin-bottom">
            <div class="w3-padding-64">
                <i class="fas fa-phone fa-5x"></i>
                <p style="color: #fff">Shop phone</p>
            </div>
            <div class=" w3-container w3-black" style=" height: 180px;">
                <p><b>ኣድራሻ (Contact)</b></p>
                <p>ኦንላይን ቆጸራ ክትሕዙ ምስ ትደልዩ በዚ ዌብሳይት ወይ ዝስዕብ ቁጽሪ ደውሉ <br>To book an appointment online, please call 901-1193-0017</p>
            </div>
        </div>
        <div class="w3-third w3-center w3-container w3-margin-bottom">
            <div class="w3-padding-64">
                <i class="fas fa-clock fa-5x"></i>
                <p style="color: #fff">Opening hours</p>
            </div>
            <div class="w3-container w3-black" style="height: 180px;">
                <p><b>ሰዓታት ስራሕ (Opening Hour)</b></p>
                <p>Mon-Fri: 8:00am - 7:00pm</p>
            </div>
        </div>
    </div>
</div>


<!DOCTYPE html>
<html>
<head>
    <title>Our Barbers</title>
    <style>
        /* Add some styling to enhance the appearance */
        .w3-sand {
            background-color: #fdf5e6;
        }

        .w3-large {
            font-size: 20px;
        }

        .w3-center {
            text-align: center;
        }

        .w3-padding-48 {
            padding: 48px;
        }

        .w3-tag {
            background-color: #000;
            padding: 5px;
        }

        .w3-wide {
            font-weight: bold;
        }

        .w3-row-padding {
            margin: 0 -16px;
        }

        .w3-third {
            width: 33.33%;
            padding: 16px;
        }

        .w3-container {
            position: relative;
        }

        .w3-black {
            background-color: #000 !important;
            color: #fff !important;
        }

        .w3-circle {
            border-radius: 50%;
        }

        .rating {
        direction: rtl;
        unicode-bidi: bidi-override;
        text-align: center;
    }
    
    .rating input[type="radio"]:checked ~ label {
        color: gold;
    }
    
    .rating label {
        display: inline-block;
        cursor: pointer;
        color: #ddd;
        font-size: 24px;
        transition: color 0.2s;
        float: center;
    }
    
    .rating label:hover,
    .rating label:hover ~ label {
        color: gold;
    }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
        }

        .rating label i {
            transition: color 0.3s;
        }

        .rating input:checked ~ label {
            color: #ffc107;
        }

        .rating:not(:checked) label:hover,
        .rating:not(:checked) label:hover ~ label {
            color: #ffc107;
        }

        .rating input:checked + label:hover,
        .rating input:checked ~ label:hover,
        .rating label:hover ~ input:checked ~ label,
        .rating input:checked ~ label:hover ~ label {
            color: #ff8f00;
        }

        .rating label:hover i,
        .rating label:hover ~ label i,
        .rating input:checked ~ label i {
            color: #ff8f00;
        }

        .rating input[type="radio"]:checked ~ label {
        color: gold;
    }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 1rem;
            cursor: pointer;
            border-radius: 4px;
        }

        .submit-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 1rem;
        cursor: pointer;
        border-radius: 4px;
    }

    .sticky-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    </style>
</head>
<body>

</body>
</html>



<!-- Call to Action Button -->
<div class="call-to-action w3-center w3-padding-top-64">
    <a href="#appointment-section" style="font-size:30px;" class="w3-white w3-text-dark w3-btn w3-border">BOOK AN
        APPOINTMENT</a>
</div>



<!-- Pricing Section-->
<div class="w3-container" id="price-section">
    <div class="w3-content w3-center" style="max-width:700px; font-weight: 600;">
        <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">SERVICE MENU</span></h5>

        <center><p style="font-size: 16px; color: #555; background-color: #f9f9f9; cursor: pointer; padding: 10px; border: 1px solid #ccc; border-radius: 4px; text-align: center; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Click on the style names to see the descriptions.</p>
</center>

        <div class="w3-panel w3-black" onclick="toggleDescription('haircut')">
            <h4 style="cursor: pointer;">Haircut - $50 - $60</h4>
        </div>

    <div id="haircut-description" style="display: none;">
        <img src="hairct.jpeg" alt="Haircut" width="200">
        <p>The Haircut is a versatile style that involves trimming and shaping the hair to achieve a desired look. It can vary in length, texture, and design, catering to individual preferences. The price range for a Haircut is $50 to $60.</p>
    </div>

    <div class="w3-panel w3-black" onclick="toggleDescription('beard-trimming')">
        <h4 style="cursor: pointer;">Beard Trimming - $20 - $25</h4>
    </div>

    <div id="beard-trimming-description" style="display: none;">
        <img src="beardtrimming.jpeg" alt="Beard Trimming" width="200">
        <p>Beard Trimming involves shaping and grooming the facial hair to maintain a neat and polished appearance. It helps to maintain a well-defined beard length and contour. The price range for Beard Trimming is $20 to $25.</p>
    </div>

        <div class="w3-panel w3-black" onclick="toggleDescription('kidscut')">
            <h4 style="cursor: pointer;">Kid's Cut - $40 - $45</h4>
        </div>

        <div id="kidscut-description" style="display: none;">
            <img src="kids.jpeg" alt="Kid's Cut" width="200">
            <p>This is a specialized haircut service for kids aged 12 and below. Our experienced barbers provide a comfortable and fun haircut experience for children, ensuring they leave with a stylish look. The price range for Kid's Cut is $40 to $45.</p>
        </div>

        <div id="kidscut-description" style="display: none;">
            <p>This is a specialized haircut service for kids aged 12 and below. Our experienced barbers provide a comfortable and fun haircut experience for children, ensuring they leave with a stylish look. The price range for Kid's Cut is $40 to $45.</p>
        </div>

        <div class="w3-panel w3-black" onclick="toggleDescription('haircut-shave')">
             <h4 style="cursor: pointer;">Haircut & Shave - $120 - $150</h4>
        </div>

        <div id="haircut-shave-description" style="display: none;">
            <img src="shave.jpeg" alt="Haircut & Shave" width="200">
            <p>Haircut & Shave is a combination service that includes both a stylish haircut and a traditional shave. It offers a complete grooming experience, providing a fresh haircut and a smooth, clean shave. The price range for Haircut & Shave is $120 to $150.</p>
        </div>

        <div class="w3-panel w3-black" onclick="toggleDescription('buzzcut')">
            <h4 style="cursor: pointer;">Buzz Cut - $27 - $37</h4>
        </div>

    <div id="buzzcut-description" style="display: none;">
        <img src="buzz.jpeg" alt="Buzz Cut" width="200">
        <p>The Buzz Cut is a short and low-maintenance hairstyle that involves cutting the hair very close to the scalp. It offers a clean and minimalist look, suitable for those who prefer a simple and easy-to-maintain style. The price range for the Buzz Cut is $27 to $37.</p>
    </div>
          
        </div>
    </div>
</div>

<!-- Appointment Form Section -->
<div class="w3-container w3-padding-64" id="appointment-section">
    <!-- <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">BOOK AN APPOINTMENT</span></h5> -->
    <div class="w3-content w3-center" style="max-width: 500px; margin: 0 auto;">
        <form action="book_appointment.php" method="post">
            <div class="w3-row-padding w3-padding-large">
                <div class="w3-half w3-container">
                    <input class="w3-input w3-border" type="text" placeholder="Name" name="name" required>
                </div>
                <div class="w3-half w3-container">
                    <input class="w3-input w3-border" type="email" placeholder="Email" name="email" required>
                </div>
            </div>
            <div class="w3-row-padding w3-padding-large">
                <div class="w3-half w3-container">
                    <input class="w3-input w3-border" type="tel" placeholder="Phone" name="phone" required>
                </div>
                <div class="w3-half w3-container">
                    <input class="w3-input w3-border" type="date" placeholder="Date" name="date" required>
                </div>
            </div>
            <div class="w3-row-padding w3-padding-large">
                <div class="w3-container">
                    <select class="w3-select w3-border" name="hour" required>
                        <option value="" disabled selected>Select Hour</option>
                        <option value="8:00am">8:00am</option>
                        <option value="9:00am">9:00am</option>
                        <option value="10:00am">10:00am</option>
                        <option value="11:00am">11:00am</option>
                        <option value="12:00pm">12:00pm</option>
                        <option value="01:00pm">01:00pm</option>
                        <option value="02:00pm">02:00pm</option>
                        <option value="03:00pm">03:00pm</option>
                        <option value="04:00pm">04:00pm</option>
                        <option value="05:00pm">05:00pm</option>
                        <option value="06:00pm">06:00pm</option>
                        <option value="07:00pm">07:00pm</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>
            <div class="w3-row-padding w3-padding-large">
                <div class="w3-container">
                    <button type="submit" class="w3-button w3-black w3-round-large">Book Appointment</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Add refresh button for small screens or responsive layout -->
   
    <div class="sticky-button">
    <a class="w3-button w3-green w3-round-large w3-hide-large w3-hide-medium" id="refresh-icon">
        <i class="fas fa-sync-alt"></i> <!-- Font Awesome refresh icon -->
    </a>
</div>


</div>


<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#273036" fill-opacity="1" d="M0,192L48,186.7C96,181,192,171,288,186.7C384,203,480,245,576,250.7C672,256,768,224,864,197.3C960,171,1056,149,1152,154.7C1248,160,1344,192,1392,208L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
<footer class="w3-container w3-center w3-padding-16 w3-light-gray">
    <p>&copy; 2023 Barber Website. All rights reserved. | Designed by Benu</p>
</footer>
</div>


<!-- End page content -->
<script>
    function bookAppointment() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var date = document.getElementById("date").value;
        var hour = document.getElementById("hour").value;

        // Perform validation here

        // Make a request to the server to book the appointment
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "book_appointment.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Process the response from the server
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Appointment booked successfully!");
                } else {
                    alert("Failed to book appointment. Please try again later.");
                }
            }
        };
        var data = "name=" + encodeURIComponent(name) + "&email=" + encodeURIComponent(email) + "&phone=" + encodeURIComponent(phone) + "&date=" + encodeURIComponent(date) + "&hour=" + encodeURIComponent(hour);
        xhr.send(data);
    }
    
    var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("w3-image");
            if (n > x.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = x.length }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "block";
        }

        var slideIndex = 1;
    showSlides(slideIndex);

    function plusDivs(n) {
        showSlides(slideIndex += n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("w3-image");

        if (n > slides.length) {
            slideIndex = 1;
        }

        if (n < 1) {
            slideIndex = slides.length;
        }

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex - 1].style.display = "block";
        setTimeout(function() {
            plusDivs(1);
        }, 3000); // Change slide every 3 seconds
    }

    function submitForm(barberName) {
    // Get the rating value
    var rating = document.querySelector('input[name="rating"]:checked').value;
    
    // Construct the URL with parameters
    var url = "confirmation.php";
    url += "?barberName=" + encodeURIComponent(barberName);
    url += "&rating=" + encodeURIComponent(rating);
    
    // Redirect to the confirmation page
    window.location.href = url;
  }
    
   // Toggle the visibility of the content and image for each section
   function toggleContent(sectionId) {
        const content = document.getElementById(sectionId + 'Content');
        const image = content.querySelector('.item-image');
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
        image.style.display = content.style.display === 'none' ? 'none' : 'block';
    }
    
    function toggleDescription(elementId) {
      var description = document.getElementById(elementId + '-description');
      if (description.style.display === 'none') {
         description.style.display = 'block';
      } else {
         description.style.display = 'none';
      }
   }

   const michaelRatingStars = document.querySelectorAll('input[name="michael_rating"]');
const sandraRatingStars = document.querySelectorAll('input[name="sandra_rating"]');
const calebRatingStars = document.querySelectorAll('input[name="caleb_rating"]');

const michaelAverageRatingElement = document.getElementById('michael-average-rating');
const sandraAverageRatingElement = document.getElementById('sandra-average-rating');
const calebAverageRatingElement = document.getElementById('caleb-average-rating');

// Add event listeners to each rating star for Michael
michaelRatingStars.forEach(star => {
    star.addEventListener('change', calculateAverageRating);
});

// Add event listeners to each rating star for Sandra
sandraRatingStars.forEach(star => {
    star.addEventListener('change', calculateAverageRating);
});

// Add event listeners to each rating star for Caleb
calebRatingStars.forEach(star => {
    star.addEventListener('change', calculateAverageRating);
});

// Function to calculate and display the average rating for each barber
function calculateAverageRating() {
    let michaelTotalRating = 0;
    let michaelSelectedCount = 0;
    let sandraTotalRating = 0;
    let sandraSelectedCount = 0;
    let calebTotalRating = 0;
    let calebSelectedCount = 0;

    // Calculate total rating and count of selected stars for Michael
    michaelRatingStars.forEach(star => {
        if (star.checked) {
            michaelTotalRating += parseInt(star.value);
            michaelSelectedCount++;
        }
    });

    // Calculate total rating and count of selected stars for Sandra
    sandraRatingStars.forEach(star => {
        if (star.checked) {
            sandraTotalRating += parseInt(star.value);
            sandraSelectedCount++;
        }
    });

    // Calculate total rating and count of selected stars for Caleb
    calebRatingStars.forEach(star => {
        if (star.checked) {
            calebTotalRating += parseInt(star.value);
            calebSelectedCount++;
        }
    });

    // Calculate the average rating for each barber
    const michaelAverageRating = michaelSelectedCount > 0 ? michaelTotalRating / michaelSelectedCount : 0;
    const sandraAverageRating = sandraSelectedCount > 0 ? sandraTotalRating / sandraSelectedCount : 0;
    const calebAverageRating = calebSelectedCount > 0 ? calebTotalRating / calebSelectedCount : 0;

    // Display the average rating for each barber
    michaelAverageRatingElement.textContent = `Average rating: ${michaelAverageRating.toFixed(1)} stars`;
    sandraAverageRatingElement.textContent = `Average rating: ${sandraAverageRating.toFixed(1)} stars`;
    calebAverageRatingElement.textContent = `Average rating: ${calebAverageRating.toFixed(1)} stars`;
}

// Check if total rating and selected count exist in local storage and calculate the average ratings
const storedMichaelTotalRating = localStorage.getItem('michaelTotalRating');
const storedMichaelSelectedCount = localStorage.getItem('michaelSelectedCount');
if (storedMichaelTotalRating && storedMichaelSelectedCount) {
    const michaelAverageRating = storedMichaelSelectedCount > 0 ? storedMichaelTotalRating / storedMichaelSelectedCount : 0;
    michaelAverageRatingElement.textContent = `Average rating: ${michaelAverageRating.toFixed(1)} stars`;
}

const storedSandraTotalRating = localStorage.getItem('sandraTotalRating');
const storedSandraSelectedCount = localStorage.getItem('sandraSelectedCount');
if (storedSandraTotalRating && storedSandraSelectedCount) {
    const sandraAverageRating = storedSandraSelectedCount > 0 ? storedSandraTotalRating / storedSandraSelectedCount : 0;
    sandraAverageRatingElement.textContent = `Average rating: ${sandraAverageRating.toFixed(1)} stars`;
}

const storedCalebTotalRating = localStorage.getItem('calebTotalRating');
const storedCalebSelectedCount = localStorage.getItem('calebSelectedCount');
if (storedCalebTotalRating && storedCalebSelectedCount) {
    const calebAverageRating = storedCalebSelectedCount > 0 ? storedCalebTotalRating / storedCalebSelectedCount : 0;
    calebAverageRatingElement.textContent = `Average rating: ${calebAverageRating.toFixed(1)} stars`;
}

function toggleMenu() {
        var menu = document.getElementById("responsiveMenu");
        menu.classList.toggle("w3-hide");
    }

    function toggleMenu() {
        var menu = document.getElementById("responsiveMenu");
        menu.classList.toggle("w3-hide");
    }

    document.getElementById('refresh-icon').addEventListener('click', function() {
        window.location.reload();
    });

</script>

</body>
</html>
