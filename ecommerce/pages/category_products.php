<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: left;
            background-color: #ffffff;
            color: #000000;
            padding: 20px 20px 20px 100px;
            margin: 0;
        }

        .products {
            background-color: #ffffff;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .product {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .product img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .product h3 {
            font-size: 1.2em;
            margin: 10px 0;
        }

        .product p {
            margin: 10px 0;
            color: #666;
        }

        .product a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .product a:hover {
            text-decoration: underline;
        }

        .product form {
            margin-top: 10px;
        }

        .product label {
            display: block;
            margin-bottom: 5px;
        }

        .product input[type="number"] {
            width: 50px;
            padding: 5px;
            margin-bottom: 10px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button, a.view-cart-button {
            background-color: #007BFF;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
            border-radius: 5px;
            font-size: 1em;
        }

        button:hover, a.view-cart-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    include 'database.php';
    require('header.php');

    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];

        // Fetch the category name
        $stmt_category = $pdo->prepare("SELECT name FROM categories WHERE id = ?");
        $stmt_category->execute([$category_id]);
        $category = $stmt_category->fetch(PDO::FETCH_ASSOC);

        if ($category) {
            echo "<h2>{$category['name']}</h2>";
            echo "<div class='products'>";

            // Fetch the products for this category
            $stmt_products = $pdo->prepare("SELECT * FROM products WHERE category_id = ?");
            $stmt_products->execute([$category_id]);
            $products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $product) {
                echo "<div class='product'>";
                echo "<a href='product_info.php?id={$product['id']}'>";
                echo "<img src='../images/{$product['image']}' alt='{$product['name']}'>";
                echo "</a>";
                echo "<h3>{$product['name']}</h3>";
                echo "<p>₹ {$product['price']}</p>";
                echo "<form onsubmit='addToCart(event, {$product['id']})'>";
                echo "<input type='hidden' name='product_id' value='{$product['id']}'>";
                echo "<label for='quantity'>Quantity:</label>";
                echo "<input type='number' id='quantity' name='quantity' value='1' min='1'>";
                echo "<button type='submit'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "<h2>Category not found</h2>";
        }
    } else {
        echo "<h2>No category selected</h2>";
    }
    ?>
    <script>
        function addToCart(event, productId) {
            event.preventDefault();
            var quantity = event.target.querySelector('#quantity').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var popup = document.createElement('div');
                    popup.textContent = 'Product added to cart!';
                    popup.style.position = 'fixed';
                    popup.style.top = '50%';
                    popup.style.left = '50%';
                    popup.style.transform = 'translate(-50%, -50%)';
                    popup.style.backgroundColor = '#333';
                    popup.style.color = '#fff';
                    popup.style.padding = '10px';
                    popup.style.zIndex = '9999';

                    document.body.appendChild(popup);

                    setTimeout(function() {
                        document.body.removeChild(popup);
                    }, 700);
                }
            };
            xhr.send('product_id=' + encodeURIComponent(productId) + '&quantity=' + encodeURIComponent(quantity));
        }
    </script>
    <?php
   require('footer.php');
   ?>
</body>
</html>
