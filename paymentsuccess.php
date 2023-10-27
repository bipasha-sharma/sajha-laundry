<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    
    header('Location: index.php');
    exit();
}

// Include your database connection code here
// For example:
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "sixthsem";

// Create a connection to the database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_REQUEST['oid']) && isset($_REQUEST['amt']) && isset($_REQUEST['refId'])) {
    // Fetch payment details from the request
    $order_id = $_REQUEST['oid'];
    $amount = $_REQUEST['amt'];
    $ref_id = $_REQUEST['refId'];

    // Prepare and execute the INSERT statement
    $sql = "INSERT INTO payment (payment_id, amount, payment_mode, payment_date)
        VALUES (?, ?, 'eSewa', NOW())";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
    
        $customer_id = $_SESSION['customer_id'];

        $stmt->bind_param('if', $customer_id, $amount);
        $result = $stmt->execute();

        if ($result) {
            // Redirect to a success page or display a success message
            header('Location: success.php');
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // Invalid payment details
    header('Location: failure.php');
}
?>