<?php
include 'connDB.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    header('Content-Type: application/json');

    $firstName = $_POST['firstName'] ?? null;  
    $lastName = $_POST['lastName'] ?? null;
    $email = $_POST['email'] ?? null;
    $password2 = $_POST['password'] ?? null;
    $city = $_POST['city'] ?? null;
    $zipCode = $_POST['zipCode'] ?? null;

    function isEmailExists($conn, $tableName, $email) {
        $sqli = "SELECT * FROM $tableName WHERE email = '$email'";
        $result = mysqli_query($conn, $sqli);
        return mysqli_num_rows($result) > 0;
    }

    // Check if email already exists
    if (isEmailExists($conn, "singup", $email)) {
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
    } else {
        // If email doesn't exist, insert the new record
        $sql = "INSERT INTO singup (firstName, lastName, email, password, city, zipCode) VALUES ('$firstName', '$lastName', '$email', '$password2', '$city', '$zipCode')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'New record saved  successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
        }
    }
}

$conn->close();
?>
