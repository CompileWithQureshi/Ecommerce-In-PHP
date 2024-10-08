<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (Optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Main</title>
</head>
<style>

</style>

<body>

    <div class='m-5 border-bottom'>
    <?php include 'sideBar.php'?>
       <div>
            <h1 class='text-center '>Order List</h1>
     </div>
     <div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product ID</th>
                        <th>Email</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody id='table_body'>
                    <!-- Rows will be appended here -->
                </tbody>
            </table>
        </div>
    </div>



    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "../../includes/db/OrderListDB.php",
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log('response',response);
                let orderHtml='';
                $.each(response,function(i,item){
                    orderHtml+=/*html*/`
                    <tr>
                    <th>${i+1}</th>
                    <td>${item.product_id}</td>
                    <td>${item.user_email}</td>
                    <td>${item.quantity}</td>
                    <td>${item.total_cost}</td>
                    <td>${item.created_at}</td>


                    </tr>
                    `
                })
                $('#table_body').empty().append(orderHtml)
                
            }
        });
    })  
    </script>

</body>

</html>







<!-- 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
} -->