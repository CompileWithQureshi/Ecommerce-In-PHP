<?php 
include 'connDB.php';


function AddProduct($name, $price, $image, $description){
    global $conn;

    $sql = "INSERT INTO products (product_name, product_price, product_image, Description) VALUES ('$name', '$price', '$image', '$description')";

    $result=$conn->query($sql);
    if ($result === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'New record saved  successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
    }
    $conn->close();
    exit;

}


function UpdateProduct($PrId,$Prname,$Prprice,$Prdescription,){
    global $conn;

    $sql="UPDATE products SET product_name='$Prname',product_price='$Prprice',Description='$Prdescription' WHERE product_id='$PrId' ";

    $result=$conn->query($sql);
    if ($result==TRUE) {
        # code...
        echo json_encode(['status'=>'success','message'=>'Updated Product']);
    }else{
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);


    }
    $conn->close();
    exit;


}
function DeleteProduct($pointer){
    global $conn;
    $sql=" DELETE FROM products WHERE product_id=$pointer";
    $result=$conn->query($sql);
    if ($result===TRUE) {
        # code...
        echo json_encode(['status'=>'success','message'=>'Deleted ']);
    }else{
        echo json_encode(['status'=>'error','message'=>'failed '.$conn->error]);
    }
    $conn->close();
    exit;
}



if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (isset($_POST['PrName'])) {
        # code...
        $PrId=$_POST['id'];
        $Prname = $_POST['PrName'];
        $Prprice = $_POST['Pirce'];
        $Prdescription = $_POST['Desc'];

        UpdateProduct($PrId,$Prname,$Prprice,$Prdescription);
    }
    elseif (isset($_POST['Name'])) {
        $name = $_POST['Name'];
        $price = $_POST['pirce'];
        $image = $_POST['Image'];
        $description = $_POST['Description'];
        AddProduct($name, $price, $image, $description);
    } elseif (isset($_POST['pointer'])) {
       $pointer=$_POST['pointer'];
        DeleteProduct($pointer);
    }
}
?>
