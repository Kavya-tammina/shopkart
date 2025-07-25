
<?php 
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

session_start();
include('../includes/db.php');

// Check if admin is logged in
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    $query = "INSERT INTO products (name, description, price, image, category, stock)
              VALUES ('$name', '$description', '$price', '$image', '$category', '$stock')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: products.php?msg=Product added");
        exit();
    } else {
        $error = "Failed to add product.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product - ShopKart</title>
</head>
<body>
    <h2>Add New Product</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required></textarea><br><br>

        <label>Price (₹):</label><br>
        <input type="number" name="price" required><br><br>

        <label>Image Filename (e.g., product.jpg):</label><br>
        <input type="text" name="image" required><br><br>

        <label>Category:</label><br>
        <input type="text" name="category" required><br><br>

        <label>Stock:</label><br>
        <input type="number" name="stock" required><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
