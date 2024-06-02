<?php

// Check if the seller is logged in
$isSellerLoggedIn = isset($_SESSION['seller_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Admin Panel</title>
  <style>
    /* Navigation Bar */
    nav {
      background-color: #fff;
      color: #000;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 5px;
    }

    .navbar a {
      color: #000;
      text-decoration: none;
      padding: 10px;
    }

    #logo{
      height: 50px;
      width: 190px;
    }

    .navbar .logo input {
      padding: 5px;
      margin-left: 10px;
    }

    .zoom {
      background-color: #c8c8c8;
      transition: background-color 0.4s;
      border-radius: 28px;
      color: black;
      border: none;
      padding: 10px 10px;
      font-size: 16px;
      cursor: pointer;
    }

    .zoom:hover {
      transform: scale(01.5);
      background-color: #a0a0a0
    }

    .zoom i {
      transition: transform 0.2s;
    }

    .zoom:hover i {
      transform: scale(1.2);
    }

    .navbar .nav-links {
      list-style: none;
      display: flex;
      align-items: center;
    }

    .navbar .nav-links li {
      margin-left: 10px;
    }


    /* Category Items */
    .categories {
      display: flex;
      justify-content: space-around;
      padding: 20px;
      background-color: #000;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .category-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      cursor: pointer;
    }
    .category-item a{
      text-decoration: none;
      color: #fff;
    }
    .category-item span {
      font-size: 14px;
      margin-top: 5px;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="logo">
      <a href="../pages/home.php"><img id="logo" src="logo.jpg" alt=""></a>
      </a>
    </div>
    <div class="search-bar">
      <h1>Welcome Seller !</h1>
    </div>
    <ul class="nav-links">
      <?php if ($isSellerLoggedIn): ?>
        <li><a href="seller_logout.php" class="zoom">Logout</a></li>
      <?php else: ?>
        <li><a href="seller_home.php" class="zoom">Home</a></li>
      <?php endif; ?>
      <li><a href="support.php" class="zoom">Contact Support</a></li>
    </ul>
  </nav>

  <div class="categories">
    <div class="category-item">
      <a href="add_product.php">Add product</a>
    </div>

    <div class="category-item">
      <a href="orders.php">View order</a>
    </div>

    <div class="category-item">
      <a href="remove_product.php">Remove product</a>
    </div>

  </div>

</body>

</html>