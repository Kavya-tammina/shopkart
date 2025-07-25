<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders - ShopKart</title>
</head>
<body>
    <h2>My Orders</h2>
    <table border="1">
        <tr>
            <th>Order ID</th><th>Total</th><th>Status</th><th>Payment</th><th>Date</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td>₹<?= $row['total_price'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['payment_method'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
