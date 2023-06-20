<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the form is submitted
  if (isset($_POST['michael_rating'])) {
    $rating = $_POST['michael_rating'];
    
    // Process the rating here (e.g., save it to a database)
    // You can add your custom logic to handle the rating as needed
    
    // Redirect back to the confirmation page with the rating information
    $redirectUrl = 'confirmation.php?barberName=Michael&rating=' . $rating;
    header('Location: ' . $redirectUrl);
    exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the form is submitted
  if (isset($_POST['caleb_rating'])) {
    $rating = $_POST['caleb_rating'];
    
    // Process the rating here (e.g., save it to a database)
    // You can add your custom logic to handle the rating as needed
    
    // Redirect back to the confirmation page with the rating information
    $redirectUrl = 'confirmation.php?barberName=Caleb&rating=' . $rating;
    header('Location: ' . $redirectUrl);
    exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the form is submitted
  if (isset($_POST['sandra_rating'])) {
    $rating = $_POST['sandra_rating'];
    
    // Process the rating here (e.g., save it to a database)
    // You can add your custom logic to handle the rating as needed
    
    // Redirect back to the confirmation page with the rating information
    $redirectUrl = 'confirmation.php?barberName=Sandra&rating=' . $rating;
    header('Location: ' . $redirectUrl);
    exit();
  }
}
?>
