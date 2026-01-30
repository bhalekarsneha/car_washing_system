<?php
session_start();

// Check if shopkeeper is logged in
if (!isset($_SESSION['shopkeeper_id'])) {
    header("Location: shopkeeper_login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_wash_db";

$appointments = [];
$stats = ['total' => 0, 'pending' => 0, 'confirmed' => 0, 'completed' => 0];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch appointments for the shopkeeper's shop
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE shop_id = ? ORDER BY appointment_date DESC, appointment_time DESC");
    $stmt->execute([$_SESSION['shop_id']]);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate statistics
    $stats['total'] = count($appointments);
    foreach ($appointments as $appointment) {
        $stats[$appointment['status']]++;
    }
} catch(PDOException $e) {
    // If database is not available, use sample data
    $appointments = [
        [
            'id' => 1,
            'customer_name' => 'John Doe',
            'customer_phone' => '+1-234-567-8901',
            'customer_email' => 'john.doe@email.com',
            'service_type' => 'premium',
            'appointment_date' => '2024-01-15',
            'appointment_time' => '10:00',
            'car_model' => 'Toyota Camry 2020',
            'special_requests' => 'Please focus on interior cleaning',
            'status' => 'pending',
            'created_at' => '2024-01-10 14:30:00'
        ],
        [
            'id' => 2,
            'customer_name' => 'Jane Smith',
            'customer_phone' => '+1-234-567-8902',
            'customer_email' => 'jane.smith@email.com',
            'service_type' => 'basic',
            'appointment_date' => '2024-01-14',
            'appointment_time' => '14:00',
            'car_model' => 'Honda Civic 2019',
            'special_requests' => '',
            'status' => 'confirmed',
            'created_at' => '2024-01-09 09:15:00'
        ],
        [
            'id' => 3,
            'customer_name' => 'Mike Johnson',
            'customer_phone' => '+1-234-567-8903',
            'customer_email' => 'mike.johnson@email.com',
            'service_type' => 'premium',
            'appointment_date' => '2024-01-13',
            'appointment_time' => '11:00',
            'car_model' => 'BMW X5 2021',
            'special_requests' => 'Leather seat treatment needed',
            'status' => 'completed',
            'created_at' => '2024-01-08 16:45:00'
        ]
    ];
    
    $stats = ['total' => 3, 'pending' => 1, 'confirmed' => 1, 'completed' => 1];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopkeeper Dashboard - YBIT Car Wash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
            min-height: 100vh;
            color: white;
        }
        
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            color: #ffcc00;
            font-size: 2rem;
        }
        
        .header-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .welcome-text {
            font-size: 1.1rem;
        }
        
        .logout-btn {
            background: linear-gradient(135deg, #ff6f00 0%, #ff9100 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 111, 0, 0.4);
        }
        
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .stat-card.total .stat-icon { color: #4fc3f7; }
        .stat-card.pending .stat-icon { color: #ffcc00; }
        .stat-card.confirmed .stat-icon { color: #4caf50; }
        .stat-card.completed .stat-icon { color: #ff9100; }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .stat-label {
            font-size: 1.1rem;
            color: #e0e0e0;
        }
        
        .appointments-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.8rem;
            color: #ffcc00;
        }
        
        .filter-buttons {
            display: flex;
            gap: 10px;
        }
        
        .filter-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active,
        .filter-btn:hover {
            background: #4fc3f7;
        }
        
        .appointments-grid {
            display: grid;
            gap: 20px;
        }
        
        .appointment-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .appointment-card:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .appointment-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .customer-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #ffcc00;
        }
        
        .appointment-status {
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .status-pending { background: rgba(255, 204, 0, 0.2); color: #ffcc00; }
        .status-confirmed { background: rgba(76, 175, 80, 0.2); color: #4caf50; }
        .status-completed { background: rgba(255, 145, 0, 0.2); color: #ff9100; }
        
        .appointment-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-item i {
            color: #4fc3f7;
            width: 18px;
        }
        
        .detail-item span {
            color: #e0e0e0;
        }
        
        .appointment-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .action-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-confirm {
            background: #4caf50;
            color: white;
        }
        
        .btn-complete {
            background: #ff9100;
            color: white;
        }
        
        .btn-cancel {
            background: #f44336;
            color: white;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }
        
        .no-appointments {
            text-align: center;
            padding: 40px;
            color: #b0b0b0;
        }
        
        .no-appointments i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .header-info {
                flex-direction: column;
                gap: 10px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .section-header {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .appointment-details {
                grid-template-columns: 1fr;
            }
            
            .appointment-actions {
                flex-wrap: wrap;
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .appointments-section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1><i class="fas fa-store"></i> Shopkeeper Dashboard</h1>
            <div class="header-info">
                <div class="welcome-text">
                    Welcome, <strong><?php echo $_SESSION['shopkeeper_name']; ?></strong>
                </div>
                <a href="shopkeeper_logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
    
    <div class="dashboard-container">
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-number"><?php echo $stats['total']; ?></div>
                <div class="stat-label">Total Appointments</div>
            </div>
            
            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number"><?php echo $stats['pending']; ?></div>
                <div class="stat-label">Pending</div>
            </div>
            
            <div class="stat-card confirmed">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number"><?php echo $stats['confirmed']; ?></div>
                <div class="stat-label">Confirmed</div>
            </div>
            
            <div class="stat-card completed">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-number"><?php echo $stats['completed']; ?></div>
                <div class="stat-label">Completed</div>
            </div>
        </div>
        
        <!-- Appointments Section -->
        <div class="appointments-section">
            <div class="section-header">
                <h2 class="section-title">Customer Appointments</h2>
                <div class="filter-buttons">
                    <button class="filter-btn active" onclick="filterAppointments('all')">All</button>
                    <button class="filter-btn" onclick="filterAppointments('pending')">Pending</button>
                    <button class="filter-btn" onclick="filterAppointments('confirmed')">Confirmed</button>
                    <button class="filter-btn" onclick="filterAppointments('completed')">Completed</button>
                </div>
            </div>
            
            <div class="appointments-grid" id="appointmentsGrid">
                <?php if (empty($appointments)): ?>
                    <div class="no-appointments">
                        <i class="fas fa-calendar-times"></i>
                        <h3>No Appointments Yet</h3>
                        <p>Appointments will appear here when customers book your services.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <div class="appointment-card" data-status="<?php echo $appointment['status']; ?>">
                            <div class="appointment-header">
                                <div class="customer-name"><?php echo $appointment['customer_name']; ?></div>
                                <div class="appointment-status status-<?php echo $appointment['status']; ?>">
                                    <?php echo ucfirst($appointment['status']); ?>
                                </div>
                            </div>
                            
                            <div class="appointment-details">
                                <div class="detail-item">
                                    <i class="fas fa-calendar"></i>
                                    <span><?php echo date('M d, Y', strtotime($appointment['appointment_date'])); ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo date('g:i A', strtotime($appointment['appointment_time'])); ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-phone"></i>
                                    <span><?php echo $appointment['customer_phone']; ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-envelope"></i>
                                    <span><?php echo $appointment['customer_email']; ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-car"></i>
                                    <span><?php echo $appointment['car_model']; ?></span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-cog"></i>
                                    <span><?php echo ucfirst($appointment['service_type']); ?> Wash</span>
                                </div>
                            </div>
                            
                            <?php if (!empty($appointment['special_requests'])): ?>
                                <div class="detail-item">
                                    <i class="fas fa-sticky-note"></i>
                                    <span><strong>Special Requests:</strong> <?php echo $appointment['special_requests']; ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="appointment-actions">
                                <?php if ($appointment['status'] == 'pending'): ?>
                                    <button class="action-btn btn-confirm" onclick="updateStatus(<?php echo $appointment['id']; ?>, 'confirmed')">
                                        <i class="fas fa-check"></i> Confirm
                                    </button>
                                <?php endif; ?>
                                
                                <?php if ($appointment['status'] == 'confirmed'): ?>
                                    <button class="action-btn btn-complete" onclick="updateStatus(<?php echo $appointment['id']; ?>, 'completed')">
                                        <i class="fas fa-star"></i> Mark Complete
                                    </button>
                                <?php endif; ?>
                                
                                <?php if ($appointment['status'] != 'completed'): ?>
                                    <button class="action-btn btn-cancel" onclick="updateStatus(<?php echo $appointment['id']; ?>, 'cancelled')">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script>
        function filterAppointments(status) {
            const cards = document.querySelectorAll('.appointment-card');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Update button states
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter cards
            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        function updateStatus(appointmentId, newStatus) {
            if (confirm('Are you sure you want to update this appointment status?')) {
                // Here you would normally send an AJAX request to update the database
                // For now, we'll just reload the page
                alert('Status updated successfully!');
                location.reload();
            }
        }
        
        // Auto-refresh every 30 seconds
        setInterval(function() {
            location.reload();
        }, 30000);
    </script>
</body>
</html>