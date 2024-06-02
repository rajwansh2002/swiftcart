<?php
session_start();

// Check if the seller is logged in
if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit;
}

// Include header and database connection if needed
require('seller_header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://img.freepik.com/free-vector/isometric-sales-representative-illustration_52683-83013.jpg?w=1060&t=st=1716797639~exp=1716798239~hmac=70a9e48f9e2094cbe18d7848fdededafb77fd6861d4ef7eb0b0b0da28fd76b54');
                        background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8) ;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            background-color: #f1f1f1;
            margin: 10px 0;
            /* padding: 15px; */
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        ul li h2 {
            margin: 0 0 10px 0;
            color: #007BFF;
        }
        ul li p {
            margin: 0;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <p><strong>Here are some general points to keep in mind as a seller:</strong></p>
        <ul>
            <li>
                <h2>Quality Products</h2>
                <p>Ensure that the products you list are of high quality. High-quality products lead to satisfied customers and fewer returns.</p>
            </li>
            <li>
                <h2>Accurate Descriptions</h2>
                <p>Provide accurate and detailed descriptions of your products. This helps customers make informed purchasing decisions.</p>
            </li>
            <li>
                <h2>Clear Images</h2>
                <p>Upload clear and high-resolution images of your products from multiple angles. Good visuals attract more buyers.</p>
            </li>
            <li>
                <h2>Competitive Pricing</h2>
                <p>Price your products competitively. Research the market to ensure your prices are in line with similar products.</p>
            </li>
            <li>
                <h2>Prompt Shipping</h2>
                <p>Ship your products promptly and provide tracking information. Timely delivery leads to positive reviews.</p>
            </li>
            <li>
                <h2>Customer Service</h2>
                <p>Provide excellent customer service. Respond to customer inquiries and resolve issues quickly and professionally.</p>
            </li>
            <li>
                <h2>Manage Inventory</h2>
                <p>Keep track of your inventory to avoid overselling. Update your listings if items are out of stock.</p>
            </li>
            <li>
                <h2>Follow Policies</h2>
                <p>Adhere to the platform's policies and guidelines. This helps maintain a good standing and avoid penalties.</p>
            </li>
        </ul>
    </div>
</body>
</html>

<?php
require('seller_footer.php');
?>
