<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P2P Money Transfer</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navigation Bar */
        nav {
            background-color: #333;
            color: #fff;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        nav .logo {
            font-size: 24px;
            font-weight: bold;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 10px;
            position: relative; /* Add this */
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 0px;
            display: block;
        }

        /* Dropdown Styles */
        .dropdown {
            display: none;
            position: absolute;
            background-color: #333;
            top: 40px; /* Adjust this if necessary */
            left: 0;
            min-width: 150px;
            z-index: 1000;
        }

        .dropdown a {
            display: block;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
        }

        .dropdown a:hover {
            background-color: #444;
        }

        nav ul li:hover .dropdown {
            display: block;
        }

        /* Hero Section */
        .hero {
            background-color: #f2f2f2;
            padding: 50px;
            text-align: center;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .hero button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Features Section */
        .features {
            background-color: #e6e6e6;
            padding: 50px;
            text-align: center;
        }

        .features h2 {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .features .feature-item {
            display: inline-block;
            width: 30%;
            margin: 0 10px;
            vertical-align: top;
        }

        .features .feature-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .features .feature-item p {
            font-size: 16px;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        /* Popup Form */
        .login-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .login-popup .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            position: relative;
        }

        .login-popup .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .login-popup .form-container input[type="text"],
        .login-popup .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-popup .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-popup .form-container button:hover {
            background-color: #45a049;
        }

        .login-popup .form-container .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 20px;
            color: #333;
            cursor: pointer;
        }
        .button{
            padding: 5px 24px;
            border: 2px solid #fff;
            background: transparent;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:active{
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">GWABU</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li class="services">
                <a href="#">Services</a>
                <div class="dropdown">
                    <a href="#">Apply Online</a>
                    <a href="#">Apply ATM</a>
                    <a href="#">Apply Loan</a>
                </div>
            </li>
            <li><a href="contact_us.php">Complaint</a></li>
            <li><a class="button" href="#" id="login-btn">Login</a></li>
        </ul>
    </nav>

    <div class="hero">
        <h1>Welcome to Our Bank</h1>
        <p>Discover the best banking solutions for your financial needs.</p>
        <a href="reg.php"><button>Apply Online</button></a> 
        <button id="admin-login-btn">Admin Login</button> 
    </div>

    <div class="features">
        <h2>Our Features</h2>
        <div class="feature-item">
            <h3>Secure Banking</h3>
            <p>Enjoy the peace of mind with our robust security measures.</p>
        </div>
        <div class="feature-item">
            <h3>Convenient Services</h3>
            <p>Access your accounts anytime, anywhere with our user-friendly platform.</p>
        </div>
        <div class="feature-item">
            <h3>Personalized Advice</h3>
            <p>Get tailored financial guidance from our experienced professionals.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 GWABU. All rights reserved.</p>
    </footer>

    <div class="login-popup" id="login-popup">
        <div class="form-container">
            <span class="close-btn" id="close-btn">&times;</span>
            <h2 align="center">Login</h2>
            <form action="signin.php" method="POST">
                <input type="text" name="email" placeholder="Enter your email" required>
                <input type="password" name="psw" placeholder="Enter your password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <div class="login-popup" id="admin-login-popup">
        <div class="form-container">
            <span class="close-btn" id="admin-close-btn">&times;</span>
            <h2 align="center">Admin Login</h2>
            <form action="admin_dashboard1.php" method="POST">
                <input type="text" name="admin_email" placeholder="Enter admin email" required>
                <input type="password" name="admin_psw" placeholder="Enter admin password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script>
        // Get elements
        var loginBtn = document.getElementById('login-btn');
        var loginPopup = document.getElementById('login-popup');
        var closeBtn = document.getElementById('close-btn');

        var adminLoginBtn = document.getElementById('admin-login-btn');
        var adminLoginPopup = document.getElementById('admin-login-popup');
        var adminCloseBtn = document.getElementById('admin-close-btn');

        // Open user login popup
        loginBtn.onclick = function() {
            loginPopup.style.display = 'flex';
        }

        // Close user login popup
        closeBtn.onclick = function() {
            loginPopup.style.display = 'none';
        }

        // Open admin login popup
        adminLoginBtn.onclick = function() {
            adminLoginPopup.style.display = 'flex';
        }

        // Close admin login popup
        adminCloseBtn.onclick = function() {
            adminLoginPopup.style.display = 'none';
        }

        // Close popup when clicking outside the form
        window.onclick = function(event) {
            if (event.target == loginPopup) {
                loginPopup.style.display = 'none';
            } else if (event.target == adminLoginPopup) {
                adminLoginPopup.style.display = 'none';
            }
        }
    </script>
</body>
</html>
