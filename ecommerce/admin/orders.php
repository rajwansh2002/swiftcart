<?php
// Set session cookie parameters
session_set_cookie_params([
    'lifetime' => 0, // expire when the browser is closed
    'path' => '/',
    'domain' => '',
    'secure' => true, // or false if not using HTTPS
    'httponly' => true,
    'samesite' => 'Strict' // or 'Lax'
]);

session_start();
include '../pages/database.php';


// Check if the seller is logged in
if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit;
}

// Check if form is submitted to update order status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['order_status'];

    // Update order status
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $order_id]);
}

// Query to fetch all orders with address information
$stmt = $pdo->prepare("SELECT o.*, a.address_line_1, a.address_line_2, a.city, a.state, a.country, a.postal_code
                       FROM orders o
                       JOIN addresses a ON o.user_id = a.user_id
                       ORDER BY o.created_at DESC");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch order items for all orders
$orderItemsStmt = $pdo->prepare("SELECT oi.order_id, oi.product_id, oi.quantity, oi.price AS item_price
                                 FROM order_items oi
                                 WHERE oi.order_id IN (SELECT id FROM orders)");
$orderItemsStmt->execute();
$orderItems = $orderItemsStmt->fetchAll(PDO::FETCH_ASSOC);

// Group order items by order_id
$orderItemsByOrderId = [];
foreach ($orderItems as $item) {
    $orderItemsByOrderId[$item['order_id']][] = $item;
}

// Combine orders with their items
foreach ($orders as &$order) {
    $order['items'] = $orderItemsByOrderId[$order['id']] ?? [];
}
unset($order); // Break the reference
?>

<!DOCTYPE html>
<html>
<head>
    <?php require('seller_header.php'); ?>
    <title>Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .orders-container {
            position: relative;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .orders-heading {
            font-family: 'Arial', sans-serif;
            font-size: 36px;
            color: #333;
            text-align: center;
            padding: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr.new {
            background-color: white;
        }

        tr.pending {
            background-color: #ffcdd2;
        }

        tr.processing {
            background-color: #fff9c4;
        }

        tr.shipped {
            background-color: #bbdefb;
            color: white;
        }

        tr.delivered {
            background-color: #c8e6c9;
        }

        tr:hover {
            background-color: #e6e6e6;
        }

        .complete-button {
            background-color: #1d72ae;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition-duration: 0.4s;
        }

        .complete-button:hover {
            background-color: #45a049;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            font-size: 16px;
            font-family: inherit;
            cursor: pointer;
            outline: none;
        }

        select:hover {
            border-color: #aaa;
        }

        select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        select:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="orders-container">
        <h1 class="orders-heading">Orders</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th>Order Status</th>
                    <th>Address Line 1</th>
                    <th>Address Line 2</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                    <th>Products</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($orders) > 0): ?>
                    <?php foreach ($orders as $order): ?>
                        <?php
                            // Determine row color based on order status
                            $rowColor = '';
                            switch ($order['status']) {
                                case 'New':
                                    $rowColor = 'new';
                                    break;
                                case 'Pending':
                                    $rowColor = 'pending';
                                    break;
                                case 'Processing':
                                    $rowColor = 'processing';
                                    break;
                                case 'Shipped':
                                    $rowColor = 'shipped';
                                    break;
                                case 'Delivered':
                                    $rowColor = 'delivered';
                                    break;
                            }
                        ?>
                        <tr class="<?php echo $rowColor; ?>">
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td><?php echo htmlspecialchars($order['address_line_1']); ?></td>
                            <td><?php echo htmlspecialchars($order['address_line_2']); ?></td>
                            <td><?php echo htmlspecialchars($order['city']); ?></td>
                            <td><?php echo htmlspecialchars($order['state']); ?></td>
                            <td><?php echo htmlspecialchars($order['country']); ?></td>
                            <td><?php echo htmlspecialchars($order['postal_code']); ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($order['items'] as $item): ?>
                                        <li>Product ID: <?php echo htmlspecialchars($item['product_id']); ?>, Quantity: <?php echo htmlspecialchars($item['quantity']); ?>, Price: <?php echo htmlspecialchars($item['item_price']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
                                    <select name="order_status">
                                        <option value="New" <?php echo $order['status'] == 'New' ? 'selected' : ''; ?>>New</option>
                                        <option value="Pending" <?php echo $order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="Processing" <?php echo $order['status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                                        <option value="Shipped" <?php echo $order['status'] == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                                        <option value="Delivered" <?php echo $order['status'] == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                                    </select>
                                    <button type="submit" name="update_status" class="complete-button">Update Status</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12">No orders.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
require('seller_footer.php');
?>
