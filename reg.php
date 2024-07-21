<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navigation Bar */
        nav {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        /* Container */
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top:-20px;
            padding: 20px;
        }

        .form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            width: 100%;
            margin-top:50px;
        }

        .form h1 {
            text-align: center;
            margin-bottom: 50px;
            color:#007bff;
        }

        .form .input_box {
            margin-bottom: 15px;
            width: calc(50% - 10px);
        }

        .form .input_box.full-width {
            width: 100%;
        }

        .form .input_box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form .input_box input[type="text"],
        .form .input_box input[type="email"],
        .form .input_box input[type="password"],
        .form .input_box input[type="file"],
        .form .input_box input[type="date"],
        .form .input_box select {
            width: 80%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form .button {
            width: 10%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            align:center;
        }

        .form .login_signup {
            text-align: center;
            margin-top: 15px;
        }

        .form .login_signup a {
            color: #007bff;
            text-decoration: none;
        }

        .form .column {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top:20px;
        }

        .form .column .input_box {
            flex: 1 1 calc(50% - 10px);
            margin-bottom: 20px;
        }

        .form .column .input_box.full-width {
            flex: 1 1 100%;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .column{

            margin-top:30px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">GWABU</div>
        <ul>
            
            <li><a href="contact_us.php">Contact</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="form signup_form">
            <form action="signup.php" method="POST" enctype="multipart/form-data">
                <h1>Registration Form</h1>
                
                <div class="column">
                    <div class="input_box">
                        <label for="user_name">Name</label>
                        <input type="text" id="user_name" placeholder="Enter your Name" name="user_name" required/>
                    </div>
                    <div class="input_box">
                        <label for="user_id">User ID</label>
                        <input type="text" id="user_id" placeholder="Enter your User ID" name="user_id" required/>
                    </div>
                    <div class="input_box">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Enter your email" name="email" required/>
                    </div>
                    <div class="input_box">
                        <label for="psw">Password</label>
                        <input type="password" id="psw" placeholder="Create password" name="psw" required/>
                    </div>
                    <div class="input_box">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" placeholder="Enter your phone number" name="phone" required/>
                    </div>
                    <div class="input_box">
                        <label for="occupation">Occupation</label>
                        <input type="text" id="occupation" placeholder="Enter your occupation" name="occupation" required/>
                    </div>
                    <div class="input_box">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select your gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="input_box">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required/>
                    </div>
                    <div class="input_box">
                        <label for="marital_status">Marital Status</label>
                        <select id="marital_status" name="marital_status" required>
                            <option value="">Select your marital status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="input_box">
                        <label for="beneficiary_name">Beneficiary Name</label>
                        <input type="text" id="beneficiary_name" placeholder="Enter beneficiary name" name="beneficiary_name" required/>
                    </div>
                    <div class="input_box">
                        <label for="aadhaar_details">Aadhaar Number</label>
                        <input type="text" id="aadhaar_details" placeholder="Enter Aadhaar number" name="aadhaar_details" required/>
                    </div>
                    <div class="input_box">
                        <label for="pan_card_no">PAN Card Number</label>
                        <input type="text" id="pan_card_no" placeholder="Enter PAN card number" name="pan_card_no" required/>
                    </div>
                    <div class="input_box full-width">
                        <label for="user_pic">User Picture</label>
                        <input type="file" id="user_pic" name="user_pic" accept="image/*" required/>
                    </div>
                    <div class="input_box full-width">
                        <label for="current_address">Current Address</label>
                        <input type="text" id="current_address" placeholder="Enter your current address" name="current_address" required/>
                    </div>
                    <div class="input_box full-width">
                        <label for="permanent_address">Permanent Address</label>
                        <input type="text" id="permanent_address" placeholder="Enter your permanent address" name="permanent_address" required/>
                    </div>
                </div>
                <button class="button" type="submit">Submit</button>
                <div class="login_signup">Already have an account? <a href="index.php">Login</a></div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 GWABU. All rights reserved.</p>
    </footer>
</body>
</html>
