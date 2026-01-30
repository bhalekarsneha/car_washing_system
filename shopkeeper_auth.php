<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_wash_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];
        
        // Check credentials
        $stmt = $conn->prepare("SELECT * FROM shopkeepers WHERE username = ? AND password = ?");
        $stmt->execute([$input_username, $input_password]);
        $shopkeeper = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($shopkeeper) {
            $_SESSION['shopkeeper_id'] = $shopkeeper['id'];
            $_SESSION['shopkeeper_name'] = $shopkeeper['name'];
            $_SESSION['shop_id'] = $shopkeeper['shop_id'];
            header("Location: shopkeeper_dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid username or password!";
            header("Location: shopkeeper_login.php");
            exit();
        }
    }
} catch(PDOException $e) {
    // If database connection fails, use default credentials
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input_username = $_POST['username'];
        $input_password = $_POST['password'];
        
        // Default shopkeeper credentials
        if ($input_username === 'admin' && $input_password === 'admin123') {
            $_SESSION['shopkeeper_id'] = 1;
            $_SESSION['shopkeeper_name'] = 'Admin';
            $_SESSION['shop_id'] = 1;
            header("Location: shopkeeper_dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid username or password! (Default: admin/admin123)";
            header("Location: shopkeeper_login.php");
            exit();
        }
    }
}
?>