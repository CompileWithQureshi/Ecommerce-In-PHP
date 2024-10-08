<?php
    include 'connDB.php';


    $sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    // Fetch all rows as an associative array
    while ($row = $result->fetch_assoc()) {
        // Do something with each row (e.g., print or store in an array)
        $products[] = $row;
        // or you can use: echo "ID: " . $row['id'] . " - Name: " . $row['name'] . "<br>";
    }
} else {
    echo "No results found";
}
$conn->close();

echo json_encode($products);

?>