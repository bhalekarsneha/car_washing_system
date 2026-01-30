<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_wash_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $shop_id = $_POST['shop_id'];
        $shop_name = $_POST['shop_name'];
        $customer_name = $_POST['customer_name'];
        $customer_phone = $_POST['customer_phone'];
        $customer_email = $_POST['customer_email'];
        $service_type = $_POST['service_type'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $car_model = $_POST['car_model'];
        $special_requests = $_POST['special_requests'];
        
        $stmt = $conn->prepare("INSERT INTO appointments (shop_id, shop_name, customer_name, customer_phone, customer_email, service_type, appointment_date, appointment_time, car_model, special_requests, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())");
        
        $stmt->execute([$shop_id, $shop_name, $customer_name, $customer_phone, $customer_email, $service_type, $appointment_date, $appointment_time, $car_model, $special_requests]);
        
        $success = true;
        $message = "Appointment booked successfully!";
    }
} catch(PDOException $e) {
    $success = false;
    $message = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - YBIT Car Wash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1a237e 0%, #283593 50%, #3949ab 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            padding: 20px;
        }
        
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .success-icon {
            font-size: 4rem;
            color: #4fc3f7;
            margin-bottom: 20px;
        }
        
        .error-icon {
            font-size: 4rem;
            color: #ff5722;
            margin-bottom: 20px;
        }
        
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #ffcc00;
        }
        
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #ffcc00 0%, #ffd740 100%);
            color: #1a237e;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 204, 0, 0.4);
            margin: 10px;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 204, 0, 0.6);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
            color: white;
        }
        
        .btn-secondary:hover {
            box-shadow: 0 8px 20px rgba(26, 35, 126, 0.6);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($success) && $success): ?>
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Booking Confirmed!</h1>
            <p><?php echo $message; ?></p>
            <p>You will receive a confirmation email shortly with all the details.</p>
        <?php else: ?>
            <div class="error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h1>Booking Failed</h1>
            <p><?php echo isset($message) ? $message : "Something went wrong. Please try again."; ?></p>
        <?php endif; ?>
        
        <div>
            <a href="services.php" class="btn">Book Another Appointment</a>
            <a href="home.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
</body>
</html>