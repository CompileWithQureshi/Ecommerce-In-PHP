<?php
include 'connDB.php';

function UserLoginList(){
    global $conn; 
    $sql = "SELECT * FROM singup";
    $result = $conn->query($sql);
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
}

function ProductList() {
    global $conn;

    $sql = "SELECT product_name, product_price FROM products";
    $result = $conn->query($sql);
    $product = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product[] = $row;
        }
    }

    echo json_encode($product);
}


function OrderList(){
    global $conn;
    $sql=" SELECT  order_id, quantity, total_Cost FROM orderslist";
    $result=$conn->query($sql);
    $orderData=[];
    if ($result->num_rows > 0) {
        # code...
        while ($row=$result->fetch_assoc()) {
            # code...
            $orderData[]=$row;

        }
    }
    echo json_encode($orderData);
}
// Unified action handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Call the corresponding function based on 'action'
    if ($action === 'UserLoginList') {
        UserLoginList();
    } elseif ($action === 'ProductList') {
        ProductList();
    }elseif ($action === 'OrderList') {
        OrderList();
    }
}

$conn->close();
exit;
?>
