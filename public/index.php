<?php
require_once '../src/products.php';

// Set the response header to JSON
header('Content-Type: application/json');

// POST: Add a new product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $product_name = $data['product_name'] ?? '';
    $price = $data['price'] ?? '';

    if (checkDuplicate($product_name)) {
        echo json_encode(['error' => 'Product already exists']);
        http_response_code(400);
    } else {
        addProduct($product_name, $price);
        echo json_encode(['success' => 'Product added successfully']);
    }
}

// GET: Retrieve all products
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $products = getProducts();
    echo json_encode($products);
}
?>
