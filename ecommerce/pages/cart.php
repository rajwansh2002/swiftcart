<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative;
            min-height: 200vh; /* Ensure the body is at least twice the viewport height */
        }

        body:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://img.freepik.com/premium-vector/shopping-cart-with-shopping-bag-illustration_249405-124.jpg?w=996');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1;
        }

        .cart-container {
            min-height: 100vh; /* Ensure the cart container covers at least the viewport height */
        }

        .cart-container table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-container th, .cart-container td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .cart-container th {
            background-color: #f2f2f2;
        }

        .cart-container h1 {
            text-align: center;
            color: #333;
        }

        .cart-container .message {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        .cart-container .error {
            text-align: center;
            color: red;
            margin-bottom: 20px;
        }

        .cart-container a {
            display: inline-block;
            text-align: center;
            background-color: #1d72ae;
            border-radius: 4px;
            border: none;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            margin: 10px auto;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .cart-container a:hover {
            background-color: rgb(23, 186, 251);
        }
    </style>
</head>
<?php
require('header.php');
?>
<body>
    <div class="cart-container">
        <h1>Shopping Cart</h1>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo htmlspecialchars($item['price']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div style="text-align: center;">
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <a href="checkout.php">Proceed to Checkout</a>
            <?php else: ?>
                <a href="home.php">Browse Products</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php
require('footer.php');
?>
