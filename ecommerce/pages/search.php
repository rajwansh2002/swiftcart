<?php
session_start();
include 'database.php';

// Function to clean the input by removing non-alphanumeric characters
function cleanInput($input) {
    return preg_replace('/[^a-zA-Z0-9]/', '', $input);
}

// Get the search query from the URL and clean it
$query = isset($_GET['query']) ? $_GET['query'] : '';
$cleanedQuery = cleanInput($query);

if ($cleanedQuery != '') {
    // Use prepared statements to prevent SQL injection
    $stmt = $pdo->prepare("
        SELECT * FROM products 
        WHERE REPLACE(REPLACE(REPLACE(REPLACE(name, '-', ''), '_', ''), ' ', ''), '/', '') LIKE ? 
        OR REPLACE(REPLACE(REPLACE(REPLACE(description, '-', ''), '_', ''), ' ', ''), '/', '') LIKE ?
    ");
    $searchTerm = '%' . $cleanedQuery . '%';
    $stmt->execute([$searchTerm, $searchTerm]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $products = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    require('header.php');
    ?>
    <title>Search Results</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
    }

    .products {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        padding: 20px;
        justify-items: center;
    }

    .product {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 15px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
        width: 100%;
        max-width: 250px;
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

    .product h2 {
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
</style>

</head>
<body>
    <h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>
    <?php if (count($products) > 0): ?>
        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product">
                <a href="product_info.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                    <img src="../images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </a>
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p>Price: <?php echo htmlspecialchars($product['price']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</body>
</html>
<?php
require('footer.php');
?>
