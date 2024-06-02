<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Swift Cart</title>
    <?php
    require('header.php');
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
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('privacy.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1;
        }

        .privacy-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        } 

        .privacy-container h1, .privacy-container h2, .privacy-container p {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .privacy-container h2 {
            margin-top: 30px;
            font-size: 24px;
        }

        .privacy-container p {
            font-size: 16px;
            line-height: 1.6;
        }

        .privacy-container ul {
            list-style-type: none;
            padding: 0;
        }

        .privacy-container li {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="privacy-container">
        <h1>Privacy Policy</h1>
        <h2>Introduction</h2>
        <p>Welcome to Swift Cart Technologies Pvt. Ltd. Your privacy is critically important to us.</p>
        <p>Swift Cart Technologies Pvt. Ltd. is located at:</p>
        <p>DDU Street, Pant Park,<br>Gorakhpur, Uttar Pradesh, 273015,<br>India</p>
        <h2>Information We Collect</h2>
        <p><strong>We collect various types of information in connection with the services we provide, including:</strong></p>
        <ul>
            <li>Personal identification information (Name, email address, phone number, etc.)</li>
            <li>Payment information</li>
            <li>Usage data</li>
        </ul>
        <h2>How We Use Information</h2>
        <p><strong>We use the information we collect in various ways, including to:</strong></p>
        <ul>
            <li>Provide, operate, and maintain our website</li>
            <li>Improve, personalize, and expand our website</li>
            <li>Understand and analyze how you use our website</li>
            <li>Develop new products, services, features, and functionality</li>
            <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
            <li>Process your transactions and manage your orders</li>
            <li>Send you emails</li>
            <li>Find and prevent fraud</li>
        </ul>
        <h2>Sharing Information</h2>
        <p><strong>We may share the information we collect with:</strong></p>
        <ul>
            <li>Service providers who help us operate our business, such as payment processors and hosting services</li>
            <li>Affiliates and partners who provide services on our behalf</li>
            <li>Law enforcement or government authorities if required by law</li>
        </ul>
        <h2>Contact Us</h2>
        <p>If you have any questions about this Privacy Policy, you can contact us at:</p>
        <p>Email: support@swiftcart.com<br>Phone: +91-945-487-6170</p>
    </div>
</body>
<?php
require('footer.php');
?>
</html>
