<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

session_start();
include '../includes/db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - ShopKart</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        a { text-decoration: none; padding: 5px 10px; background: #007BFF; color: white; border-radius: 5px; }
        a.logout { background: red; float: right; }
    </style>
</head>
<body>

<h2>Admin Dashboard</h2>
<a href="add_product.php">➕ Add Product</a>
<a href="logout.php" class="logout">🚪 Logout</a>
<p><a href="orders.php">Manage Orders</a></p>


<table>
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Category</th><th>Stock</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>₹<?= $row['price'] ?></td>
            <td><?= $row['category'] ?></td>
            <td><?= $row['stock'] ?></td>
            <td>
                <a href="edit_product.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
