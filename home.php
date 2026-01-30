<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Washing System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80') no-repeat center center fixed;
            background-size: cover;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: relative;
        }
        
        /* Shopkeeper Login Button in Corner */
        .login-btn-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .login-btn {
            background: linear-gradient(135deg, #ff6f00 0%, #ff9100 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 111, 0, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            z-index: 1000;
        }
        
        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 111, 0, 0.6);
        }
        
        .login-btn:active {
            transform: translateY(1px);
        }
        
        /* Main Content */
        .container {
            max-width: 800px;
            width: 100%;
            margin: auto;
            padding: 40px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            margin-top: 40px;
        }
        
        .logo {
            font-size: 4rem;
            color: #4fc3f7;
            margin-bottom: 20px;
            text-shadow: 0 0 15px rgba(79, 195, 247, 0.5);
        }
        
        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #ffcc00;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        }
        
        p {
            font-size: 1.4rem;
            margin-bottom: 30px;
            line-height: 1.6;
            color: #e0e0e0;
        }
        
        /* Current Services Button */
        .services-btn {
            background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(26, 35, 126, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 10px auto;
        }
        
        .services-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(26, 35, 126, 0.6);
        }
        
        .services-btn:active {
            transform: translateY(1px);
        }
        
        .water-drop {
            position: absolute;
            background: rgba(79, 195, 247, 0.3);
            border-radius: 50%;
            animation: drop 7s linear infinite;
            z-index: -1;
        }
        
        @keyframes drop {
            0% {
                transform: translateY(-100px) scale(0.5);
                opacity: 0;
            }
            10% {
                opacity: 0.7;
            }
            90% {
                opacity: 0.5;
            }
            100% {
                transform: translateY(500px) scale(1.2);
                opacity: 0;
            }
        }
        
        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }
            
            p {
                font-size: 1.1rem;
            }
            
            .login-btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
            
            .services-btn {
                padding: 12px 30px;
                font-size: 1.1rem;
            }
            
            .login-btn-container {
                top: 15px;
                right: 15px;
            }
            
            .container {
                padding: 30px 20px;
                margin-top: 60px;
            }
        }

        @media (max-width: 480px) {
            .login-btn {
                padding: 8px 16px;
                font-size: 0.8rem;
            }
            
            .services-btn {
                padding: 10px 25px;
                font-size: 1rem;
            }
            
            .login-btn-container {
                top: 10px;
                right: 10px;
            }
            
            .logo {
                font-size: 3rem;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .container {
                margin-top: 50px;
            }
        }
    </style>
</head>
<body>
    <!-- Shopkeeper Login Button Fixed in Corner -->
    <div class="login-btn-container">
        <a href="shopkeeper_login.php" class="login-btn">
            <i class="fas fa-store"></i> Shopkeeper Login
        </a>
    </div>
    
    <!-- Animated water drops -->
    <div class="water-drop" style="left: 10%; width: 20px; height: 20px; animation-delay: 0s;"></div>
    <div class="water-drop" style="left: 20%; width: 15px; height: 15px; animation-delay: 1s;"></div>
    <div class="water-drop" style="left: 30%; width: 25px; height: 25px; animation-delay: 2s;"></div>
    <div class="water-drop" style="left: 40%; width: 10px; height: 10px; animation-delay: 3s;"></div>
    <div class="water-drop" style="left: 50%; width: 20px; height: 20px; animation-delay: 4s;"></div>
    <div class="water-drop" style="left: 60%; width: 15px; height: 15px; animation-delay: 5s;"></div>
    
    <!-- Main Content -->
    <div class="container">
        <div class="logo">
            <i class="fas fa-car"></i>
        </div>
        <h1>CAR WASHING SYSTEM</h1>
        <p>Fast, reliable and eco-friendly car wash service tailored to your needs. Book your spot today</p>
        
        <!-- Current Services Button -->
        <button class="services-btn" onclick="window.location.href='services.php'">
            <i class="fas fa-concierge-bell"></i> Current Services
        </button>
    </div>

    <script>
        // Create more water drops dynamically
        function createWaterDrops() {
            const body = document.querySelector('body');
            for (let i = 0; i < 15; i++) {
                const drop = document.createElement('div');
                drop.classList.add('water-drop');
                
                // Random properties
                const size = Math.random() * 20 + 10;
                const left = Math.random() * 100;
                const delay = Math.random() * 7;
                
                drop.style.width = `${size}px`;
                drop.style.height = `${size}px`;
                drop.style.left = `${left}%`;
                drop.style.animationDelay = `${delay}s`;
                
                body.appendChild(drop);
            }
        }
        
        // Call function to create additional water drops
        createWaterDrops();
    </script>
</body>
</html>