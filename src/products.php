<?php
require_once 'db.php';

// Add a new product
function addProduct($product_name, $price) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (product_name, price) VALUES (:product_name, :price)");
    $stmt->execute([
        ':product_name' => $product_name,
        ':price' => $price
    ]);
}

// Get all products
function getProducts() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Check for duplicate product
function checkDuplicate($product_name) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE product_name = :product_name");
    $stmt->execute([':product_name' => $product_name]);
    return $stmt->fetchColumn() > 0;
}
?>
