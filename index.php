<?php
include('includes/db.php');
session_start();
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<h2>Welcome to ShopKart</h2>
<a href="add_to_cart.php?product_id=<?= $row['id'] ?>">Add to Cart</a>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <p>Price: ₹<?php echo $row['price']; ?></p>
        <form method="post" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
<?php } ?>
<?php
session_start();
if (isset($_SESSION['user_logged_in'])) {
    echo "Welcome, " . $_SESSION['user_name'] . " | <a href='logout.php'>Logout</a>";
} else {
    echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";
}
?>

