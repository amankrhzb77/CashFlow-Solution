<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "decentralized_finance";

// Connect to MySQL database
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die('Connect Error('. mysqli_connect_errno() .')'. mysqli_connect_error());
} else {
    $SELECT = "SELECT * FROM user_info WHERE user_id = ?";
    $SELECT_ATM = "SELECT * FROM atm_database WHERE user_id = ?";
    $CHECK_LOAN = "SELECT * FROM loans WHERE user_id = ?";

    // Prepare the select statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Prepare the select statement for ATM application
    $stmt_atm = $conn->prepare($SELECT_ATM);
    $stmt_atm->bind_param("s", $user_id);
    $stmt_atm->execute();
    $result_atm = $stmt_atm->get_result();
    $atm_application = $result_atm->fetch_assoc();
    $stmt_atm->close();

    // Check for existing loan application
    $stmt_loan = $conn->prepare($CHECK_LOAN);
    $stmt_loan->bind_param("s", $user_id);
    $stmt_loan->execute();
    $result_loan = $stmt_loan->get_result();
    $loan_application = $result_loan->fetch_assoc();
    $stmt_loan->close();

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
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
        .container {
            flex: 1;
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
        }
        .user-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .user-details .detail {
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .user-details .detail label {
            font-weight: bold;
        }
        .user-details .detail span {
            display: block;
            margin-top: 5px;
        }
        .user-pic {
            text-align: center;
            margin-bottom: 20px;
        }
        .user-pic img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
        .logout-btn {
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .balance-display {
            display: inline-block;
            margin-left: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }
        .form-container {
            margin-top: 20px;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }
    </style>
    <script>
        function checkBalance() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_balance.php", true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.amount !== undefined) {
                        document.getElementById("balance-display").innerText = "Balance: ₹" + response.amount.toFixed(2);
                    } else if (response.error) {
                        alert(response.error);
                    }
                } else {
                    alert("Error fetching balance.");
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <nav>
        <div class="logo">GWABU</div>
        <ul>
            
            <form action="logout.php" method="POST" style="display: inline;">
                <button type="submit" name="logout" class="logout-btn">Logout</button>
            </form>
        </ul>
    </nav>

    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>

        <div class="user-pic">
            <img src="<?php echo $user['user_pic']; ?>" alt="User Picture">
        </div>

        <div class="container">
            <a href="javascript:void(0);" class="btn" onclick="checkBalance()">Check Balance</a>
            <span id="balance-display" class="balance-display"></span>
            <form action="transaction_details.php" method="POST" style="display: inline;">
                <button type="submit" class="btn">View Transactions</button>
            </form>
            <form action="transfer_amount.php" method="POST" style="display: inline;">
                <button type="submit" class="btn">Transfer Amount</button>
            </form>
            <form action="apply_loan_form.php" method="POST" style="display: inline;">
                <button type="submit" class="btn">Apply Loan</button>
            </form>

            <?php if ($user['status'] === 'active') { ?>
                <?php if ($atm_application) { ?>
                    <p>You have already applied for an ATM card.</p>
                <?php } else { ?>
                    <form action="apply_atm.php" method="POST" style="display: inline;">
                        <button type="submit" class="btn">Apply ATM Card</button>
                    </form>
                <?php } ?>
            <?php } ?>
        </div>

        <div class="user-details">
            <div class="detail">
                <label>Status:</label>
                <span><?php echo $user['status']; ?></span>
            </div> 
            <div class="detail">
                <label>Name:</label>
                <span><?php echo $user['user_name']; ?></span>
            </div>
            <div class="detail">
                <label>User ID:</label>
                <span><?php echo $user['user_id']; ?></span>
            </div>
            <div class="detail">
                <label>Account Number:</label>
                <span><?php echo $user['account_no']; ?></span>
            </div>
            <div class="detail">
                <label>IFSC Code:</label>
                <span><?php echo $user['IFSC_code']; ?></span>
            </div>
            <div class="detail">
                <label>Email:</label>
                <span><?php echo $user['email']; ?></span>
            </div>
            <div class="detail">
                <label>Phone:</label>
                <span><?php echo $user['phone']; ?></span>
            </div>
            <div class="detail">
                <label>Occupation:</label>
                <span><?php echo $user['occupation']; ?></span>
            </div>
            <div class="detail">
                <label>Gender:</label>
                <span><?php echo $user['gender']; ?></span>
            </div>
            <div class="detail">
                <label>Date of Birth:</label>
                <span><?php echo $user['dob']; ?></span>
            </div>
            <div class="detail">
                <label>Marital Status:</label>
                <span><?php echo $user['marital_status']; ?></span>
            </div>
            <div class="detail">
                <label>Beneficiary Name:</label>
                <span><?php echo $user['beneficiary_name']; ?></span>
            </div>
            <div class="detail">
                <label>Aadhaar Number:</label>
                <span><?php echo $user['aadhaar_details']; ?></span>
            </div>
            <div class="detail">
                <label>PAN Card Number:</label>
                <span><?php echo $user['pan_card_no']; ?></span>
            </div>
            <div class="detail">
                <label>Current Address:</label>
                <span><?php echo $user['current_address']; ?></span>
            </div>
            <div class="detail">
                <label>Permanent Address:</label>
                <span><?php echo $user['permanent_address']; ?></span>
            </div>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 GWABU. All rights reserved.</p>
    </footer>
</body>
</html>
