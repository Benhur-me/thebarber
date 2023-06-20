<!DOCTYPE html>
<html>
<head>
  <title>Rating Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      text-align: center;
      padding: 20px;
    }

    h1 {
      color: #333;
      font-size: 24px;
      margin-top: 0;
    }

    p {
      color: #555;
      font-size: 18px;
    }

    .stars {
      color: #fcd30b;
      font-size: 30px;
    }

    .stars::before {
      content: "★";
    }

    .stars::after {
      content: "★";
    }
  </style>
</head>
<body>
  <?php
  $barberName = $_GET['barberName'];
  $rating = $_GET['rating'];
  ?>

  <h1>Thank you for rating to <?php echo $barberName; ?></h1>
  <p>Your rating:</p>
  
  <div class="stars">
    <?php
    for ($i = 1; $i <= $rating; $i++) {
      echo "★";
    }
    ?>
  </div>
  
  <p><?php echo $rating; ?> stars</p>
</body>
</html>
