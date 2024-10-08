<?php 
include 'connDB.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Decode JSON data
    $cartData = isset($_POST['cartData']) ? json_decode($_POST['cartData'], true) : null;
    $userData = isset($_POST['UserData']) ? json_decode($_POST['UserData'], true) : null;
    $totalCost = isset($_POST['totalCost']) ? $_POST['totalCost'] : 0;

    if ($cartData && $userData) {
        $userEmail = mysqli_real_escape_string($conn, $userData['email']);
        
        // Fetch customer id from signup table using the email
        $customerQuery = "SELECT id FROM `singup` WHERE `email` = '$userEmail'";
        $customerResult = $conn->query($customerQuery);
        
        if ($customerResult->num_rows > 0) {
            $customerData = $customerResult->fetch_assoc();
            $customerId = $customerData['id']; // Get the customer id from signup table

            // Insert a new record into the orders table and get the generated order_id
            $createdAt = date('Y-m-d H:i:s');
            $sql1 = "INSERT INTO `orders` (`customer_id`, `total_cost`, `created_at`) 
                     VALUES ('$customerId', '$totalCost', '$createdAt')";

            $result1 = $conn->query($sql1);
            
            if ($result1 === TRUE) {
                // Get the last inserted order ID
                $orderId = $conn->insert_id;

                foreach ($cartData as $items) {
                    $productId = (int)$items['id']; // Assuming `id` in `cartData` is the product ID
                    $productPrice = (float)$items['price'];
                    $productQuantity = (int)$items['quantity'];

                    // Insert into the orderslist table
                    $sql = "INSERT INTO `orderslist` (`product_id`, `order_id`, `quantity`, `price`, `user_email`, `total_cost`, `created_at`) 
                            VALUES ('$productId', '$orderId', '$productQuantity', '$productPrice', '$userEmail', '$totalCost', '$createdAt')";

                    $result = $conn->query($sql);

                    if ($result !== TRUE) {
                        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
                        $conn->close();
                        exit; 
                    }
                }

                echo json_encode(['status' => 'success', 'message' => 'New record(s) saved successfully']);
            
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
            }
        
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
    }

    $conn->close();
}
?>
