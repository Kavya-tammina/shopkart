<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT orders.id, users.name AS customer, products.name AS product, 
          orders.quantity, orders.status, orders.created_at 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          JOIN products ON orders.product_id = products.id";

$result = mysqli_query($conn, $query);
?>

<h2>All Orders</h2>
<table border="1">
    <tr><th>ID</th><th>Customer</th><th>Product</th><th>Qty</th><th>Status</th><th>Action</th></tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['customer'] ?></td>
            <td><?= $row['product'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><a href="update_status.php?id=<?= $row['id'] ?>&status=Shipped">Mark Shipped</a></td>
        </tr>
    <?php } ?>
</table>
