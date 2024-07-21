<?php
session_start(); // Start the session

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();
    // Redirect to index.php

    echo '<script type="text/javascript">
            // Use JavaScript to show a message
            alert("Logout Successfully!");
            
            // Redirect after showing the message
            window.location.href = "index.php";
          </script>';

    //header("Location: index.php");
    exit();
}
?>
