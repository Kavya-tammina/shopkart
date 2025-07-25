<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$cart_items = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id");
$total = 0;
while ($item = mysqli_fetch_assoc($cart_items)) {
    $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price FROM products WHERE id = " . $item['product_id']));
    $total += $product['price'] * $item['quantity'];
}

mysqli_query($conn, "INSERT INTO orders (user_id, total_price, created_at, status, payment_method) 
    VALUES ($user_id, $total, NOW(), 'Pending', 'Cash on Delivery')");

$order_id = mysqli_insert_id($conn);

mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

echo "<p>Order placed successfully! Order ID: $order_id</p>";
?>
