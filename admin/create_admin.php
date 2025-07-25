<?php session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

$email = "admin2@shopkart.com"; // change email to a new one
$password = password_hash("admin123", PASSWORD_DEFAULT);

$query = "INSERT INTO admin (email, password) VALUES ('$email', '$password')";
mysqli_query($conn, $query);

echo "Admin created successfully.";
?>
