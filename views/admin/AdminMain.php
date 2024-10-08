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
            <h1 class='text-center '>Over View</h1>
        </div>


    </div>
    <div class=''>
        <div class='text-start ms-5 d-flex justify-content-evenly border border-2 rounded-2'>
            <div id='userList' class='pt-2' style='width:400px;height:400px;'>


            </div>
            <div class='pt-2' id='OrderList' style='width:400px;height:400px;'>

            </div>

        </div>
        <div class='text-start ms-5 d-flex justify-content-evenly' id='productList' style=''>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
    $(document).ready(function() {

        $.ajax({
            type: "POST",
            url: "../../includes/db/ChartsDb.php?action=UserLoginList",
            data: {
                action: 'UserLoginList'
            },
            dataType: "json",
            success: function(response) {
                // console.log(response);
                initUserChart(response)

            }
        });


        $.ajax({
            type: "POST",
            url: "../../includes/db/ChartsDb.php?action=ProductList",
            data: {
                action: 'ProductList'
            },
            dataType: "json",
            success: function(response) {
                // console.log(response);
                initProductChart(response);

            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                console.log("Response Text:", xhr.responseText);
            }
        });


        $.ajax({
            type: "POST",
            url: "../../includes/db/ChartsDb.php?action=OrderList",
            data: {
                action: 'OrderList'
            },
            dataType: "json",
            success: function (response) {
                console.log('res',response);
                initOrderChart(response)
            }
        });
        // Initialize Line Chart for User List
        function initUserChart(response) {
            let nameArray = [];
            let indexArray = [];
            // console.log(typeof indexArray);
            response.forEach(item => {
                if (item.firstName && item.id) {
                    nameArray.push(item.firstName)
                    indexArray.push(item.id)
                }
            });


            var options = {
                series: [{
                    name: nameArray,
                    data: indexArray
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Users by Months',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3',
                        'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
                }
            };

            var userChart = new ApexCharts(document.querySelector("#userList"), options);
            userChart.render();
        }




        // Initialize Bar Chart for Order List
        function initOrderChart(response) {
            
            let OrderId=[];
            let quantitys=[];
            let totalCost=[];

            response.forEach(item=>{
                OrderId.push(item.order_id);
                quantitys.push(item.quantity);
                totalCost.push(item.total_Cost)
            })
            console.log(OrderId,quantitys,totalCost);
            
            var options = {
                series: [{
                    data: totalCost
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        borderRadiusApplication: 'end',
                        horizontal: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                title: {
                    text: 'product sold',
                    align: 'left'
                },
                xaxis: {
                    categories: ['backpack','bike','jeans','mobile','laptop','watch']
                }
            };

            var orderChart = new ApexCharts(document.querySelector("#OrderList"), options);
            orderChart.render();
        }

        // Initialize Pie Chart for Product List
        function initProductChart(response) {
            let priceArray = [];
            let productName = [];

            response.forEach(item => {
                if (item.product_name && item.product_price) {
                    productName.push(item.product_name);
                    priceArray.push(parseFloat(item.product_price));
                }
                
            });
            console.log('priceArray' ,priceArray);

            var options = {
                series: priceArray,
                chart: {
                    width: 380,
                    type: 'pie'
                },
                labels:productName ,
                title: {
                    text: 'product by Price',
                    align: 'left'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var productChart = new ApexCharts(document.querySelector("#productList"), options);
            productChart.render();
        }

        // Call the initialization functions
        // initUserChart();
        // initOrderChart()
    });
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