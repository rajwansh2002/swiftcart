<?php
include 'database.php';
require('header.php');

// Check if a product ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    // Display the product details
    if ($product) {
        ?>
         <style>
                    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .product h2 {
            text-align: left;
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
            padding: 5% 20% 20% 20%;
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

        button, .product button {
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

        button:hover, .product button:hover {
            background-color: #0056b3;
        }
        </style>
        <div class="product">
            <img src="../images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <h2><?php echo $product['name']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <p>Price: ₹<?php echo $product['price']; ?></p>


            
           
            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not provided.";
}
?>
<?php
require('footer.php');
?>