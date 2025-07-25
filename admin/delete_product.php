<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "DELETE FROM products WHERE id = $product_id";
    mysqli_query($conn, $query);
}

header("Location: dashboard.php");
exit();
?>
