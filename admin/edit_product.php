<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

session_start();
include('../includes/db.php');

// Check login
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}

// Get product ID from URL
if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = intval($_GET['id']);
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) !== 1) {
    echo "Product not found.";
    exit();
}

$product = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name       = $_POST['name'];
    $desc       = $_POST['description'];
    $price      = $_POST['price'];
    $category   = $_POST['category'];
    $stock      = $_POST['stock'];

    // Check if new image is uploaded
    if ($_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../images/$image");
    } else {
        $image = $product['image']; // Keep old image
    }

    // Update query
    $update = "UPDATE products SET 
                name='$name',
                description='$desc',
                price=$price,
                category='$category',
                stock=$stock,
                image='$image'
              WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        header("Location: products.php?msg=Product updated successfully");
        exit();
    } else {
        echo "Failed to update product.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product - ShopKart</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= $product['name'] ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required><?= $product['description'] ?></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" name="price" value="<?= $product['price'] ?>" required><br><br>

        <label>Category:</label><br>
        <input type="text" name="category" value="<?= $product['category'] ?>" required><br><br>

        <label>Stock:</label><br>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" required><br><br>

        <label>Current Image:</label><br>
        <img src="../images/<?= $product['image'] ?>" width="100"><br><br>

        <label>Change Image (optional):</label><br>
        <input type="file" name="image"><br><br>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
