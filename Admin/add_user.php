<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Onlinefood";

// Enable error reporting (optional, for debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Establishing connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
   


    // Prepare SQL statement to insert data into reservations table
    $sql = "INSERT INTO users (email, firstName, lastName, contact, password) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sssss", $email, $firstName, $lastName, $contact, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("User Added successfully!"); window.location.href="users.php";</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>