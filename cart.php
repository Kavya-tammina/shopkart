<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT c.id, p.name, p.price, c.quantity 
          FROM cart c
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = $user_id";
$result = mysqli_query($conn, $query);

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart - ShopKart</title>
</head>
<body>
    <h2>My Cart</h2>
    <table border="1">
        <tr>
            <th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): 
            $item_total = $row['price'] * $row['quantity'];
            $total += $item_total;
        ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td>₹<?= $row['price'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td>₹<?= $item_total ?></td>
            <td><a href="remove_from_cart.php?id=<?= $row['id'] ?>">Remove</a></td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td>₹<?= $total ?></td>
            <td></td>
        </tr>
    </table>

    <br>
    <a href="checkout.php">Proceed to Checkout</a>
</body>
</html>
