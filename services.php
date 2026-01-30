<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_wash_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // If database doesn't exist, we'll show static data
    $conn = null;
}

// Fetch shops from database or use static data
$shops = [];
if ($conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM shops ORDER BY id");
        $stmt->execute();
        $shops = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $conn = null;
    }
}

// Static data if database is not available
if (empty($shops)) {
    $shops = [
        [
            'id' => 1,
            'name' => 'Sparkle Car Wash',
            'description' => 'Premium car washing service with eco-friendly products. We provide interior and exterior cleaning, waxing, and detailing services.',
            'image' => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'price_basic' => 255,
            'price_premium' => 45,
            'location' => 'Downtown Plaza',
            'phone' => '+1-234-567-8901',
            'rating' => 4.8
        ],
        [
            'id' => 2,
            'name' => 'Quick Shine Auto',
            'description' => 'Fast and reliable car wash service. We specialize in quick exterior wash and interior vacuuming with professional grade equipment.',
            'image' => 'https://images.unsplash.com/photo-1607860108855-64acf2078ed9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'price_basic' => 20,
            'price_premium' => 35,
            'location' => 'Mall Road',
            'phone' => '+1-234-567-8902',
            'rating' => 4.5
        ],
        [
            'id' => 3,
            'name' => 'Elite Car Care',
            'description' => 'Luxury car detailing and washing service. We offer premium waxing, ceramic coating, and interior leather treatment.',
            'image' => 'https://images.unsplash.com/photo-1621905251918-48416bd8575a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'price_basic' => 35,
            'price_premium' => 65,
            'location' => 'Business District',
            'phone' => '+1-234-567-8903',
            'rating' => 4.9
        ],
        [
            'id' => 4,
            'name' => 'Eco Wash Station',
            'description' => '100% eco-friendly car wash using biodegradable products. Solar-powered equipment and water recycling system.',
            'image' => 'https://images.unsplash.com/photo-1544705088-4a4b192aa46f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
            'price_basic' => 30,
            'price_premium' => 50,
            'location' => 'Green Valley',
            'phone' => '+1-234-567-8904',
            'rating' => 4.7
        ]
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Wash Services - YBIT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), 
                        url('https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1770&q=80') no-repeat center center fixed;
            background-size: cover;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px 0;
        }
        
        .header h1 {
            font-size: 3rem;
            color: #ffcc00;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 1.2rem;
            color: #e0e0e0;
        }
        
        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(26, 35, 126, 0.4);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            z-index: 1000;
        }
        
        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(26, 35, 126, 0.6);
        }
        
        .services-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .shops-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .shop-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }
        
        .shop-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.15);
        }
        
        .shop-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        
        .shop-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .shop-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffcc00;
            margin-bottom: 5px;
        }
        
        .shop-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 204, 0, 0.2);
            padding: 5px 10px;
            border-radius: 15px;
        }
        
        .shop-rating i {
            color: #ffcc00;
        }
        
        .shop-description {
            font-size: 1rem;
            line-height: 1.6;
            color: #e0e0e0;
            margin-bottom: 20px;
        }
        
        .shop-details {
            margin-bottom: 20px;
        }
        
        .detail-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        .detail-row i {
            color: #4fc3f7;
            width: 16px;
        }
        
        .pricing {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background: rgba(0, 0, 0, 0.3);
            padding: 15px;
            border-radius: 10px;
        }
        
        .price-item {
            text-align: center;
        }
        
        .price-label {
            font-size: 0.9rem;
            color: #b0b0b0;
            margin-bottom: 5px;
        }
        
        .price-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #4fc3f7;
        }
        
        .book-btn {
            width: 100%;
            background: linear-gradient(135deg, #4fc3f7 0%, #29b6f6 100%);
            color: white;
            border: none;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(79, 195, 247, 0.4);
        }
        
        .book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 195, 247, 0.6);
        }
        
        /* Booking Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            background: linear-gradient(135deg, rgba(26, 35, 126, 0.9) 0%, rgba(40, 53, 147, 0.9) 100%);
            margin: 5% auto;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            
        }
        
        .close {
            position: absolute;
            right: 20px;
            top: 20px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .close:hover {
            color: #ffcc00;
        }
        
        .modal h2 {
            color: #ffcc00;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #e0e0e0;
            font-weight: 600;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            max-height:70vh;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4fc3f7;
            box-shadow: 0 0 10px rgba(79, 195, 247, 0.3);
        }
        
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #b0b0b0;
        }
        
        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #ffcc00 0%, #ffd740 100%);
            color: #1a237e;
            border: none;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 204, 0, 0.4);
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 204, 0, 0.6);
        }
        
        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }
            
            .shops-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .back-btn {
                padding: 10px 20px;
                font-size: 0.9rem;
                top: 15px;
                left: 15px;
            }
            
            .modal-content {
                width: 95%;
                margin: 10% auto;
                padding: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .services-container {
                padding: 0 10px;
            }
            
            .shop-card {
                padding: 20px;
            }
            
            .pricing {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <a href="home.php" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>
    
    <div class="services-container">
        <div class="header">
            <h1>Available Car Wash Services</h1>
            <p>Choose from our premium car washing partners near you</p>
        </div>
        
        <div class="shops-grid">
            <?php foreach ($shops as $shop): ?>
                <div class="shop-card">
                    <img src="<?php echo $shop['image']; ?>" alt="<?php echo $shop['name']; ?>" class="shop-image">
                    
                    <div class="shop-header">
                        <div>
                            <h3 class="shop-name"><?php echo $shop['name']; ?></h3>
                        </div>
                        <div class="shop-rating">
                            <i class="fas fa-star"></i>
                            <span><?php echo $shop['rating']; ?></span>
                        </div>
                    </div>
                    
                    <p class="shop-description"><?php echo $shop['description']; ?></p>
                    
                    <div class="shop-details">
                        <div class="detail-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo $shop['location']; ?></span>
                        </div>
                        <div class="detail-row">
                            <i class="fas fa-phone"></i>
                            <span><?php echo $shop['phone']; ?></span>
                        </div>
                    </div>
                    
                    <div class="pricing">
                        <div class="price-item">
                            <div class="price-label">Basic Wash</div>
                            <div class="price-value">Rs<?php echo $shop['price_basic']; ?></div>
                        </div>
                        <div class="price-item">
                            <div class="price-label">Premium Wash</div>
                            <div class="price-value">Rs<?php echo $shop['price_premium']; ?></div>
                        </div>
                    </div>
                    
                    <button class="book-btn" onclick="openBookingModal(<?php echo $shop['id']; ?>, '<?php echo $shop['name']; ?>')">
                        <i class="fas fa-calendar-check"></i> Book Appointment
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <!-- Booking Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeBookingModal()">&times;</span>
            <h2>Book Your Appointment</h2>
            <form id="bookingForm" method="POST" action="book_appointment.php">
                <input type="hidden" id="shopId" name="shop_id" value="">
                <input type="hidden" id="shopName" name="shop_name" value="">
                
                <div class="form-group">
                    <label for="customerName">Full Name</label>
                    <input type="text" id="customerName" name="customer_name" required placeholder="Enter your full name">
                </div>
                
                <div class="form-group">
                    <label for="customerPhone">Phone Number</label>
                    <input type="tel" id="customerPhone" name="customer_phone" required placeholder="Enter your phone number">
                </div>
                
                <div class="form-group">
                    <label for="customerEmail">Email Address</label>
                    <input type="email" id="customerEmail" name="customer_email" required placeholder="Enter your email">
                </div>
                
                <div class="form-group">
                    <label for="serviceType">Service Type</label>
                    <select id="serviceType" name="service_type" required>
                        <option value="">Select Service Type</option>
                        <option value="basic">Basic Wash</option>
                        <option value="premium">Premium Wash</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="appointmentDate">Appointment Date</label>
                    <input type="date" id="appointmentDate" name="appointment_date" required>
                </div>
                
                <div class="form-group">
                    <label for="appointmentTime">Appointment Time</label>
                    <select id="appointmentTime" name="appointment_time" required>
                        <option value="">Select Time</option>
                        <option value="09:00">9:00 AM</option>
                        <option value="10:00">10:00 AM</option>
                        <option value="11:00">11:00 AM</option>
                        <option value="12:00">12:00 PM</option>
                        <option value="13:00">1:00 PM</option>
                        <option value="14:00">2:00 PM</option>
                        <option value="15:00">3:00 PM</option>
                        <option value="16:00">4:00 PM</option>
                        <option value="17:00">5:00 PM</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="carModel">Car Model</label>
                    <input type="text" id="carModel" name="car_model" required placeholder="e.g., Toyota Camry 2020">
                </div>
                
                <div class="form-group">
                    <label for="specialRequests">Special Requests (Optional)</label>
                    <textarea id="specialRequests" name="special_requests" rows="3" placeholder="Any special instructions or requests..."></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-check"></i> Confirm Booking
                </button>
            </form>
        </div>
    </div>
    
    <script>
        function openBookingModal(shopId, shopName) {
            document.getElementById('shopId').value = shopId;
            document.getElementById('shopName').value = shopName;
            document.getElementById('bookingModal').style.display = 'block';
            
            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('appointmentDate').min = today;
        }
        
        function closeBookingModal() {
            document.getElementById('bookingModal').style.display = 'none';
            document.getElementById('bookingForm').reset();
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('bookingModal');
            if (event.target == modal) {
                closeBookingModal();
            }
        }
        
        // Handle form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Here you would normally send the data to the server
            // For now, we'll just show a success message
            alert('Booking submitted successfully! You will receive a confirmation shortly.');
            closeBookingModal();
        });
    </script>
</body>
</html>