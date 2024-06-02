<?php
session_start();
include '../pages/database.php';


// Check if the user is a seller
if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit();
}

$message = ''; // Initialize an empty message variable

// Handle product deletion
if (isset($_POST['delete'])) {
    $product_id = $_POST['product_id'];

    // Delete product from database
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    if ($stmt->execute([$product_id])) {
        $message = "Product removed successfully.";
    } else {
        $message = "Failed to remove product.";
    }
}

// Fetch all products from the database
$stmt = $pdo->query("SELECT id, name, description, price, category_id, image FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <?php require('seller_header.php'); ?>
    <title>Remove Product</title>
    <style>
        .removeprod-container {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .removeprod-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://img.freepik.com/free-vector/warehouse-staff-wearing-uniform-loading-parcel-box-checking-product-from-warehouse-delivery-logistic-storage-truck-transportation-industry-delivery-logistic-business-delivery_1150-60909.jpg?t=st=1716794979~exp=1716798579~hmac=99199324b7153e996fa99b4a2db23d2487dc8c5be8f19d73e09a4ee8ebb31ed1&w=1060');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1;
        }

        .removeprod-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .removeprod-container th, .removeprod-container td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .removeprod-container th {
            background-color: #f2f2f2;
        }

        .removeprod-container .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .removeprod-container form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .removeprod-container button {
            background-color: #1d72ae;
            border-radius: 4px;
            border: none;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
        }

        .removeprod-container button:hover {
            background-color: rgb(23, 186, 251);
        }

        .removeprod-container h1 {
            text-align: center;
            color: #333;
        }

        .message {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        .error {
            text-align: center;
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="removeprod-container">
        <?php echo $message ? "<p class='message'>$message</p>" : ''; ?>
        <div class="form-container">
            <form method="POST" action="">
                <h1>Remove Products</h1>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category ID</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['id']); ?></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo htmlspecialchars($product['description']); ?></td>
                            <td><?php echo htmlspecialchars($product['price']); ?></td>
                            <td><?php echo htmlspecialchars($product['category_id']); ?></td>
                            <td><img src="../images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width:50px;height:50px;"></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                    <button type="submit" name="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
<?php
require('seller_footer.php');
?>
