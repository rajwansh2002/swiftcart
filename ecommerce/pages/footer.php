<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        .footer-container {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .footer-section {
            width: 20%;
            margin-bottom: 20px;
        }

        .footer-section h4 {
            border-bottom: 2px solid #fff;
            padding-bottom: 5px;
            margin-bottom: 5px;
        }

        .footer-section p,
        .footer-section ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .social-links {
            padding: 0;
            margin: 0;
        }

        .social-links li {
            display: inline;
            margin-right: 8px;
        }

        .social-links a {
            color: #fff;
            text-decoration: none;
        }

        .footer-bottom {
            text-align: center;
            padding: 8px 0;
            background-color: #222;
            color: #bbb;
        }

        .footer-bottom p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="content">
        <!-- Main content of the page goes here -->
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h4>About Us</h4>
                <p>Developed by - Rajwansh Modanwal | Nikhil Maurya | Shekhar Dubey | Aniket Verma </p>
            </div>
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: support@swiftcart.com</p>
                <p>Phone: +91-945-487-6170</p>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <ul class="social-links">
                    <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
                    <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
                    <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy Swift Cart Technologies Pvt. Ltd. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>