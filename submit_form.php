<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "showroom_on_wheels";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare data for insertion
    $date = $_POST['date'];
    $customer_name = $_POST['customer_name'];
    $phone_number = $_POST['phone_number'];
    $location = $_POST['location'];
    $existing_vehicle = $_POST['existing_vehicle'];
    $own_car_model = isset($_POST['own_car_model']) ? $_POST['own_car_model'] : null;
    $interested_model = $_POST['interested_model'];
    $dealership = $_POST['dealership'];
    $test_drive = $_POST['test_drive'];
    $exchange = $_POST['exchange'];
    $hot_warm_cold = $_POST['hot_warm_cold'];

    // SQL query to insert data into database
    $sql = "INSERT INTO form_data (date, customer_name, phone_number, location, existing_vehicle, own_car_model, interested_model, dealership, test_drive, exchange, hot_warm_cold)
            VALUES ('$date', '$customer_name', '$phone_number', '$location', '$existing_vehicle', '$own_car_model', '$interested_model', '$dealership', '$test_drive', '$exchange', '$hot_warm_cold')";

    if ($conn->query($sql) === TRUE) {
        // If insertion successful, return success message
        echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully']);
    } else {
        // If insertion fails, return error message
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
    }

    // Close database connection
    $conn->close();
} else {
    // If not a POST request, return method not allowed
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}
?>
