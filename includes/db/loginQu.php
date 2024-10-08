<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecart";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if ($email && $password) {
    $sql = "SELECT * FROM singup WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error in query execution: " . $conn->error;
    } else {
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Store user info in session
            $_SESSION['user_id'] = $user['id']; // Assuming `id` is the primary key in your `singup` table
            $_SESSION['user_email'] = $user['email'];
            
            // Redirect to the main page
            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Please enter both email and password']);
}

// Close the database connection
$conn->close();
?>
