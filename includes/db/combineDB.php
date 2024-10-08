<?php
include 'connDB.php';

header('Content-Type: application/json');

$email = $_POST['email'];

$sql = "SELECT 
    SELECT o.order_id, o.created_at, o.status, o.total_cost, 
       p.name AS product_name, p.price AS product_price, oi.quantity
FROM orders o
JOIN order_items oi ON o.order_id = oi.order_id
JOIN products p ON oi.product_id = p.product_id
WHERE o.customer_id = 1;
FROM 
    singup
INNER JOIN 
    orderslist 
ON 
    singup.email = orderslist.user_email 
WHERE 
    singup.email = '$email'";

$result = $conn->query($sql);

$response = [];

if ($result && $result->num_rows > 0) {
    // Fetch all rows and store them in $response
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'email' => $row['email'],
            'city' => $row['city'],
            'zipCode' => $row['zipCode'],
            'product_name' => $row['product_name'],
            'product_image' => $row['product_image'],
            'product_description' => $row['product_description'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
            'total_cost' => $row['total_cost']
        ];
    }
    // Output the JSON response once
    echo json_encode(['data' => $response]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No records found.']);
}

$conn->close();
?>
