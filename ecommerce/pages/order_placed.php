<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Placed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
    <meta http-equiv="refresh" content="5;url=dashboard.php">
</head>
<body>
    <div class="container">
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your order. Your order has been placed successfully.</p>
        <p>Redirecting you to the dashboard (please wait a few seconds.)</p>
        <a href="home.php">Go back to homepage</a>
    </div>
</body>
</html>
