<?php
session_start(); // Start the session at the very beginning

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include your database connection file
include 'database.php';

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Check if user exists
if (!$user) {
    // If user does not exist, redirect to the login page
    header("Location: login.php");
    exit();
}

// Get the username
$username = $user['username'];

// Fetch order history
$stmt = $pdo->prepare("
    SELECT orders.id, orders.status, orders.total_amount, order_items.quantity, products.name 
    FROM orders 
    JOIN order_items ON orders.id = order_items.order_id 
    JOIN products ON order_items.product_id = products.id 
    WHERE orders.user_id = ?
");
$stmt->execute([$user_id]);
$orderHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group order items by order ID
$groupedOrders = [];
foreach ($orderHistory as $order) {
    $groupedOrders[$order['id']]['status'] = $order['status'];
    $groupedOrders[$order['id']]['total_amount'] = $order['total_amount'];
    $groupedOrders[$order['id']]['items'][] = [
        'name' => $order['name'],
        'quantity' => $order['quantity']
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    require('header2.php');
    ?>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative; /* Add this line */
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1; /* Ensure the pseudo-element is behind all other content */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2, h1 {
            font-size: 32px;
            font-family: Arial, Helvetica, sans-serif;
            color: rgb(6, 6, 127);
            font-weight: lighter;
            text-align: center;
            margin-bottom: 0px;
        }

        p {
            text-align: center;
            margin-bottom: -5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-family: Arial, sans-serif;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            text-align: center;
            text-decoration: none;
            margin: 20px auto;
            display: block;
            width: fit-content;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .item-list {
            list-style-type: none;
            padding: 0;
        }

        .item-list li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Hello, <?php echo htmlspecialchars($username); ?>!</p>
    <p>Welcome to your dashboard!</p>
    <a href="home.php" class="button">Shop right now!</a>
    <h2>Your Order History</h2>
    <?php if (count($groupedOrders) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groupedOrders as $orderId => $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($orderId); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                        <td>
                            <ul class="item-list">
                                <?php foreach ($order['items'] as $item): ?>
                                    <li><?php echo htmlspecialchars($item['name']); ?> (Quantity: <?php echo htmlspecialchars($item['quantity']); ?>)</li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</body>
<?php
require('footer.php');
?>
</html>
