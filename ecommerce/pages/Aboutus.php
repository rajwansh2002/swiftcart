<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Swift Cart</title>
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
            background-image: url('login.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1;
        }
        h2,h3{
          text-align: center;
          font-size: 30px;
          font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

        }
        .container {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        } 
    
   
    
    /* main {
      margin: 0 auto;
      padding: 20px;
    } */
  </style>
</head>
<body>
  <main>
    <div class="container">
    <h2>About Us</h2>
    <p>Welcome to Swift Cart, your one-stop destination for all your shopping needs. We are a leading online retailer, offering a wide range of products to customers worldwide.</p>   
    <h3>Our Mission</h3>
    <p>At Swift Cart, our mission is to provide an exceptional shopping experience to our customers. We strive to offer high-quality products at competitive prices, backed by excellent customer service.</p>
    
    <h3>Our Story</h3>
    <p>Swift Cart was founded in 2020 by a team of passionate individuals who saw the potential of e-commerce. Starting as a small online store, we have grown tremendously over the years, thanks to the trust and loyalty of our valued customers.</p>
    
    <h3>Our Team</h3>
    <p>Our dedicated team of professionals is committed to ensuring that every customer has a seamless and enjoyable shopping experience. From our product experts to our customer service representatives, we work tirelessly to meet and exceed your expectations.</p>
    
    <h3>Our Values</h3>
    <ul>
      <li>Customer Satisfaction: We put our customers first and strive to provide the best possible service.</li>
      <li>Quality Products: We carefully curate our products to ensure they meet the highest standards of quality.</li>
      <li>Integrity: We operate with honesty, transparency, and ethical business practices.</li>
      <li>Innovation: We continuously seek ways to improve and enhance our offerings.</li>
    </ul>

    </div>
  </main>
  <?php
require('footer.php');
?>
</body>

</html>