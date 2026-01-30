<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to YBIT</title>
    <meta http-equiv='refresh' content='3; url=home.php'>
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
            overflow: hidden;
        }
        
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(0deg);
            animation: rotate 20s linear infinite;
            z-index: -1;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .logo-container {
            margin-bottom: 25px;
        }
        
        .logo {
            height: 100px;
            width: 100px;
            object-fit: contain;
            margin: 0 auto;
            display: block;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }
        
        h1 {
            font-size: 2.8rem;
            margin-bottom: 15px;
            color: #ffcc00;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        }
        
        h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #4fc3f7;
            font-weight: 600;
        }
        
        h4 {
            font-size: 1.3rem;
            margin-bottom: 30px;
            font-weight: 400;
            line-height: 1.5;
        }
        
        .redirect-notice {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            border-radius: 12px;
            margin: 25px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .redirect-notice i {
            font-size: 1.5rem;
            color: #ffcc00;
        }
        
        .progress-container {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            overflow: hidden;
            margin: 25px 0;
        }
        
        .progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #ffcc00 0%, #ffd740 100%);
            border-radius: 4px;
            animation: progress 3s linear forwards;
        }
        
        @keyframes progress {
            from { width: 0%; }
            to { width: 100%; }
        }
        
        .manual-redirect {
            margin-top: 25px;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #ffcc00 0%, #ffd740 100%);
            color: #1a237e;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 204, 0, 0.4);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 204, 0, 0.6);
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
        
        @media (max-width: 600px) {
            h1 { font-size: 2.2rem; }
            h3 { font-size: 1.5rem; }
            h4 { font-size: 1.1rem; }
            .container { padding: 30px 20px; }
        }

        
    </style>
</head>
<body>
	    <!-- Shopkeeper Login Button in Corner -->
    <div class="login-btn-container">
        <a href="../Profilers/SProfile/index.php" class="login-btn">
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
    <div class="water-drop" style="left: 70%; width: 30px; height: 30px; animation-delay: 6s;"></div>
    <div class="water-drop" style="left: 80%; width: 18px; height: 18px; animation-delay: 0.5s;"></div>
    <div class="water-drop" style="left: 90%; width: 22px; height: 22px; animation-delay: 1.5s;"></div>
    
    <div class="container">
        <div class="logo-container">
            <img class="logo" src="https://cdn-icons-png.flaticon.com/512/3079/3079165.png" alt="Car Wash Logo">
        </div>
        
        <h1>Welcome to YBIT</h1>
        <h3>Car Washinggggg!!!</h3>
        <h4>Please Wait While we Redirect you to our Page</h4>
        
        <div class="redirect-notice">
            <i class="fas fa-sync fa-spin"></i>
            <span>You will be automatically redirected in 3 seconds</span>
        </div>
        
        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>
        
        <div class="manual-redirect">
            <p>Not redirected?</p>
            <a href="home.php" class="btn">Click Here</a>
        </div>
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
