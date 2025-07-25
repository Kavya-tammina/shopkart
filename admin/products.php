<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

session_start();
include('../includes/db.php');

// Redirect if not logged in
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}

// Fetch all products
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Products - ShopKart</title>
</head>
<body>
    <h2>Product List</h2>
    <?php if (isset($_GET['msg'])) echo "<p style='color: green;'>".$_GET['msg']."</p>"; ?>

    <a href="add_product.php">+ Add New Product</a><br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Desc</th>
                <th>Price</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['description'] ?></td>
                <td>₹<?= $row['price'] ?></td>
                <td><?= $row['category'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td><img src="../images/<?= $row['image'] ?>" width="60" height="60"></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
