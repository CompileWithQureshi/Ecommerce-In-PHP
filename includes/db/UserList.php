<?php 
include 'connDB.php';


$sql="SELECT * FROM singup";
$result =$conn->query($sql);

$table=[];
if ($result->num_rows > 0) {
    # code...
    while ($row=$result->fetch_assoc()) {
        # code...
        $table[]=$row;
    }
    echo json_encode($table);
}
$conn->close();
exit;
?>