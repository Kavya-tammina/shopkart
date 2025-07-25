<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE id = $order_id");

    header("Location: orders.php");
    exit();
}
?>
