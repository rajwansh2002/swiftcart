<?php
//
// Check if the user is logged in
//$isUserLoggedIn = isset($_SESSION['user_id']);
//
// Get the current script name to determine the active page
//$current_page = basename($_SERVER['PHP_SELF']);
//
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <title>User Panel</title>
  <style>
    .navbar {
      background-color: #fff;
      color: #000;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px;
    }

    .sub-navbar {
      background-color: #000;
      color: #fff;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      padding: 2px;
    }

    .search-bar {
      display: flex;
      background-color: #f2f2f2;
      border-radius: 25px;
      padding: 8px 10px;
      width: 600px;
      /* max-width: 400px; */
      margin:0 auto;
    }

    .search-bar form {
      display: flex;
      align-items: end;
      flex-grow: 1;
    }

    .search-bar input[type="text"] {
      flex-grow: 1;
      border: none;
      background-color: transparent;
      padding: 8px;
      font-size: 16px;
      outline: none;
    }

    .search-bar button[type="submit"] {
      border: none;
      background-color: transparent;
      cursor: pointer;
      padding: 8px;
      color: #666;
      font-size: 20px;
    }

    .search-bar button[type="submit"]:hover {
      color: #333;
    }

    .navbar a {
      color: #000;
      text-decoration: none;
      padding: 10px;
    }

    .sub-navbar a {
      color: #fff;
      text-decoration: none;
      padding: 20px;
    }

    .navbar .logo input {
      padding: 5px;
      margin-left: 10px;
    }

    .zoom {
      background-color: #c8c8c8;
      transition: background-color 0.4s;
      border-radius: 28px;
      color: #fff;
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

    .sub-navbar ul {
      list-style: none;
      display: flex;
    }
    #logo{
      height: 50px;
      width: 190px;
    }
    .sub-navbar ul li {
      /* background-color: #282828;
      border-radius: 25px; */
      margin: 0px 15px;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="logo">
      <a href="home.php"><img id="logo" src="logo.jpg" alt="Swift Cart"></a>
    </div>
    <div class="search-bar">
      <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search for products...">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <ul class="nav-links">
      <li><a href="Aboutus.php" class="zoom">About us</a></li>
      <li><a href="Feedback.php" class="zoom">Feedback</a></li>
      <li><a href="logout.php" class="zoom">Logout</a></li>
      <li><a href="dashboard.php" class="zoom"><i class="far fa-user"></i></a></li>
      <li><a href="cart.php" class="zoom"><i class="fas fa-shopping-bag"></i></a></li>
      <li><a href="../admin/seller_login.php" class="zoom"><i class="fas fa-users-cog"></i></a></li>
    </ul>
  </nav>
  <nav class="sub-navbar">
    <ul>
      <li><a href="category_products.php?category_id=1">T-SHIRT</a></li>
      <li><a href="category_products.php?category_id=2">TRACK-PANTS</a></li>
      <li><a href="category_products.php?category_id=3">CAP & HATS</a></li>
      <li><a href="category_products.php?category_id=4">EYE-WEAR</a></li>
      <li><a href="category_products.php?category_id=5">SHOES</a></li>
    </ul>
  </nav>

</body>

</html>