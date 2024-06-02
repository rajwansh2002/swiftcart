<?php
include 'D:\xampp\htdocs\ecommerce/config/database.php';

// Fetch all sellers from the database
$stmt = $pdo->query("SELECT * FROM seller");
$sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through each seller and update their password
foreach ($sellers as $seller) {
    $hashed_password = password_hash($seller['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE seller SET password = ? WHERE id = ?");
    $stmt->execute([$hashed_password, $seller['id']]);
}
?>