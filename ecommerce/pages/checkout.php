<?php
session_start();
include 'database.php';

// Function to redirect with a message
function redirect_with_message($url, $message) {
    $_SESSION['message'] = $message;
    header("Location: $url");
    exit;
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    redirect_with_message('login.php', 'Please log in to proceed with the checkout or refresh the page if you are already logged in.');
}

$user_id = $_SESSION['user_id'];

// Check if the user has an address
$stmt = $pdo->prepare("SELECT * FROM addresses WHERE user_id = ?");
$stmt->execute([$user_id]);
$user_address = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the form for adding or editing an address is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['add_address']) || isset($_POST['edit_address']))) {
    $address_line_1 = $_POST['address_line_1'];
    $address_line_2 = $_POST['address_line_2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postal_code = $_POST['postal_code'];

    if ($user_address) {
        // Update the address in the database
        $stmt = $pdo->prepare("UPDATE addresses SET address_line_1 = ?, address_line_2 = ?, city = ?, state = ?, country = ?, postal_code = ? WHERE user_id = ?");
        $stmt->execute([$address_line_1, $address_line_2, $city, $state, $country, $postal_code, $user_id]);
    } else {
        // Insert the address into the database
        $stmt = $pdo->prepare("INSERT INTO addresses (user_id, address_line_1, address_line_2, city, state, country, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $address_line_1, $address_line_2, $city, $state, $country, $postal_code]);
    }

    // Redirect to the same page with a confirmation message
    redirect_with_message('checkout.php', 'Your address has been updated successfully.');
}

// Check if the form for placing an order is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    // Check if Cash on Delivery is selected
    if (!isset($_POST['payment']) || $_POST['payment'] !== 'cod') {
        echo 'Please select Cash on Delivery.';
        exit; // Exit if Cash on Delivery is not selected
    }

    // Retrieve user_id and total_amount from session
    $total_amount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'price')) : 0;
    if ($total_amount <= 0) {
        echo 'Your cart is empty.';
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Insert order into orders table
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'New')");
    $stmt->execute([$user_id, $total_amount]);
    $order_id = $pdo->lastInsertId();

    // Insert order items into order_items table
    foreach ($_SESSION['cart'] as $id => $item) {
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $id, $item['quantity'], $item['price']]);
    }

    // Unset the cart session
    unset($_SESSION['cart']);
    
    // Redirect to order_placed.php
    header("Location: order_placed.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
/* General Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 960px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1, h2 {
    color: #222;
    font-weight: 600;
}

p {
    color: #555;
    line-height: 1.6;
}

/* Form Styles */
form {
    margin-top: 30px;
}

label {
    display: block;
    margin-bottom: 10px;
    color: #333;
    font-weight: 600;
}

input[type="text"],
input[type="number"],
input[type="radio"] {
    width: calc(100% - 22px);
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

input[type="radio"] {
    width: auto;
}

button {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 12px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    font-weight: 600;
}

button:hover {
    background-color: #0056b3;
}

/* Message Styles */
.message {
    background-color: #e0ffe0;
    border: 1px solid #b3ffb3;
    color: #4caf50;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Address Styles */
.address {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Edit Link Styles */
a.edit-link {
    color: #007BFF;
    text-decoration: none;
    font-weight: 600;
}

a.edit-link:hover {
    text-decoration: underline;
}

.radio-container {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.radio-container input[type="radio"] {
    margin-right: 10px;
}

    </style>
</head>
<body>
<div class="container">
    <h1>Checkout</h1>
    <p>Total Amount: <?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'price')) : 0; ?></p>

    <!-- Display message if any -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>

    <?php if (!$user_address || isset($_GET['edit'])): ?>
        <!-- Form for adding or editing an address -->
        <form method="POST" action="">
            <label for="address_line_1">Address Line 1:</label>
            <input type="text" id="address_line_1" name="address_line_1" value="<?php echo htmlspecialchars($user_address['address_line_1'] ?? ''); ?>" required>

            <label for="address_line_2">Address Line 2:</label>
            <input type="text" id="address_line_2" name="address_line_2" value="<?php echo htmlspecialchars($user_address['address_line_2'] ?? ''); ?>">

            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user_address['city'] ?? ''); ?>" required>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($user_address['state'] ?? ''); ?>" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($user_address['country'] ?? ''); ?>" required>

            <label for="postal_code">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($user_address['postal_code'] ?? ''); ?>" required>

            <button type="submit" name="<?php echo $user_address ? 'edit_address' : 'add_address'; ?>"><?php echo $user_address ? 'Update Address' : 'Add Address'; ?></button>
        </form>
    <?php else: ?>
        <!-- Display current address and provide an edit option -->
        <div class="address">
            <h2>Your Address</h2>
            <p><?php echo htmlspecialchars($user_address['address_line_1']); ?></p>
            <p><?php echo htmlspecialchars($user_address['address_line_2']); ?></p>
            <p><?php echo htmlspecialchars($user_address['city']); ?>, <?php echo htmlspecialchars($user_address['state']); ?>, <?php echo htmlspecialchars($user_address['country']); ?> - <?php echo htmlspecialchars($user_address['postal_code']); ?></p>
            <a href="checkout.php?edit=true" class="edit-link">Edit Address</a>
        </div>

        <!-- Form for placing an order -->
        <form method="POST" action="">
            <h2>Payment Method</h2>
            <div class="radio-container">
                <input type="radio" id="cod" name="payment" value="cod" required>
                <label for="cod">Cash on Delivery</label>
            </div>

            <button type="submit" name="place_order">Place Order</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
