<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $phone = $_POST['phone'];
    $occupation = $_POST['occupation'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $marital_status = $_POST['marital_status'];
    $beneficiary_name = $_POST['beneficiary_name'];
    $aadhaar_details = $_POST['aadhaar_details'];
    $pan_card_no = $_POST['pan_card_no'];
    $current_address = $_POST['current_address'];
    $permanent_address = $_POST['permanent_address'];

    // File upload handling
    $user_pic = $_FILES['user_pic']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($user_pic);

    // Check if uploads directory exists, if not, create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Move uploaded file
    if (!move_uploaded_file($_FILES["user_pic"]["tmp_name"], $target_file)) {
        die('File upload failed');
    }

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
        $SELECT = "SELECT user_id FROM user_info WHERE user_id = ? LIMIT 1";
        $INSERT = "INSERT INTO user_info (user_name, user_id, email, password, phone, occupation, gender, dob, marital_status, beneficiary_name, aadhaar_details, pan_card_no, user_pic, current_address, permanent_address, account_no, IFSC_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the select statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Generate IFSC code
            $IFSC_code = 'CKID0004825';

            // Start transaction
            $conn->begin_transaction();

            try {
                // Lock the table to ensure thread-safe suffix incrementation
                $conn->query("LOCK TABLES account_suffix WRITE");

                // Get the current suffix from the account_suffix table
                $result = $conn->query("SELECT suffix FROM account_suffix WHERE id = 1 FOR UPDATE");
                $row = $result->fetch_assoc();
                $suffix = $row['suffix'];

                // Increment the suffix value
                $conn->query("UPDATE account_suffix SET suffix = suffix + 1 WHERE id = 1");

                // Unlock the table after update
                $conn->query("UNLOCK TABLES");

                // Generate the account number with correct padding
                $account_no = '48251011157' . str_pad($suffix, 3, '0', STR_PAD_LEFT);

                // Prepare the insert statement
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("sssssssssssssssss", $user_name, $user_id, $email, $hashed_password, $phone, $occupation, $gender, $dob, $marital_status, $beneficiary_name, $aadhaar_details, $pan_card_no, $target_file, $current_address, $permanent_address, $account_no, $IFSC_code);
                $stmt->execute();

                // Commit transaction
                $conn->commit();

                echo '<script>alert("Registered Successfully");</script>';
                echo '<script type="text/javascript">
                    window.location.href = "index.php";
                </script>';
            } catch (Exception $e) {
                // Rollback transaction in case of error
                $conn->rollback();
                echo '<script>alert("Registration Failed: ' . $e->getMessage() . '");</script>';
                echo '<script type="text/javascript">
                    window.location.href = "index.php";
                </script>';
            }
        } else {
            echo '<script>alert("Already Registered");</script>';
            echo '<script type="text/javascript">
                window.location.href = "index.php";
            </script>';
        }
        $stmt->close();
        $conn->close();
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // echo "All fields are required";
    // die();
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $phone = $_POST['phone'];
    $occupation = $_POST['occupation'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $marital_status = $_POST['marital_status'];
    $beneficiary_name = $_POST['beneficiary_name'];
    $aadhaar_details = $_POST['aadhaar_details'];
    $pan_card_no = $_POST['pan_card_no'];
    $current_address = $_POST['current_address'];
    $permanent_address = $_POST['permanent_address'];

    // File upload handling
    $user_pic = $_FILES['user_pic']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($user_pic);

    // Check if uploads directory exists, if not, create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Move uploaded file
    if (!move_uploaded_file($_FILES["user_pic"]["tmp_name"], $target_file)) {
        die('File upload failed');
    }

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
        $SELECT = "SELECT user_id FROM user_info WHERE user_id = ? LIMIT 1";
        $INSERT = "INSERT INTO user_info (user_name, user_id, email, password, phone, occupation, gender, dob, marital_status, beneficiary_name, aadhaar_details, pan_card_no, user_pic, current_address, permanent_address, account_no, IFSC_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the select statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Generate IFSC code
            $IFSC_code = 'CKID0004825';

            // Start transaction
            $conn->begin_transaction();

            try {
                // Lock the table to ensure thread-safe suffix incrementation
                $conn->query("LOCK TABLES account_suffix WRITE");

                // Get the current suffix from the account_suffix table
                $result = $conn->query("SELECT suffix FROM account_suffix WHERE id = 1 FOR UPDATE");
                $row = $result->fetch_assoc();
                $suffix = $row['suffix'];

                // Increment the suffix value
                $conn->query("UPDATE account_suffix SET suffix = suffix + 1 WHERE id = 1");

                // Unlock the table after update
                $conn->query("UNLOCK TABLES");

                // Generate the account number with correct padding
                $account_no = '48251011157' . str_pad($suffix, 3, '0', STR_PAD_LEFT);

                // Prepare the insert statement
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("sssssssssssssssss", $user_name, $user_id, $email, $hashed_password, $phone, $occupation, $gender, $dob, $marital_status, $beneficiary_name, $aadhaar_details, $pan_card_no, $target_file, $current_address, $permanent_address, $account_no, $IFSC_code);
                $stmt->execute();

                // Commit transaction
                $conn->commit();

                echo '<script>alert("Registered Successfully");</script>';
                echo '<script type="text/javascript">
                    window.location.href = "index.php";
                </script>';
            } catch (Exception $e) {
                // Rollback transaction in case of error
                $conn->rollback();
                echo '<script>alert("Registration Failed: ' . $e->getMessage() . '");</script>';
                echo '<script type="text/javascript">
                    window.location.href = "index.php";
                </script>';
            }
        } else {
            echo '<script>alert("Already Registered");</script>';
            echo '<script type="text/javascript">
                window.location.href = "index.php";
            </script>';
        }
        $stmt->close();
        $conn->close();
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // echo "All fields are required";
    // die();
}
?>
