<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - Swift Cart Technologies Pvt. Ltd.</title>
    <?php
    require('seller_header.php');
    ?>
    <style>
        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('login.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1;
        }

        .support-container {
            background-color: rgba(255, 255, 255, 0.6);
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .support-container h1, .support-container h2, .support-container p {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .support-container h2 {
            margin-top: 30px;
            font-size: 24px;
        }

        .support-container p {
            font-size: 16px;
            line-height: 1.6;
        }

        .support-container ul {
            list-style-type: none;
            padding: 0;
        }

        .support-container li {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="support-container">
        <h1>Support</h1>
        <h2>Contact Us</h2>
        <p>If you need assistance or have any questions, you can contact us at:</p>
        <p>Email: <a href="mailto:sellersupport@swiftcart.com">sellersupport@swiftcart.com</a></p>
        <p>Phone: +91-945-487-6170</p>
        <h2>Seller Support</h2>
        <p>To register as a seller or for any other issues related to selling on our platform, please contact us at:</p>
        <p>Email: <a href="mailto:sellersupport@swiftcart.com">sellersupport@swiftcart.com</a></p>
        <h2>Customer Support</h2>
        <p>For issues related to your orders, payments, or account, you can reach out to our customer support team:</p>
        <p>Email: <a href="mailto:customersupport@swiftcart.com">customersupport@swiftcart.com</a></p>
    </div>
</body>
<?php
require('seller_footer.php');
?>
</html>
