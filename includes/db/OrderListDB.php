<?php
include 'connDB.php';

$sql="  SELECT user_email, quantity,created_at,product_id,total_cost FROM orderslist";
$result=$conn->query($sql);
$OrderList=[];
    if ($result->num_rows>0) {
        # code...
        while ($row=$result->fetch_assoc()) {
            # code...
            $OrderList[]=$row;
        }
        echo json_encode($OrderList);
    }

$conn->close();
exit;

?>