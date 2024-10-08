<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (Optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class='m-5'>
        <?php include 'sideBar.php'?>
        <div>
            <h1 class='text-center border-bottom'>Product List</h1>
        </div>
        <div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product_Name</th>
                        <th>Images</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Add product</th>
                        <th>Delete product</th>

                    </tr>
                </thead>
                <tbody id='table_body'>
                    <!-- Rows will be appended here -->
                </tbody>
            </table>
        </div>
        <div class='d-flex justify-content-center ms-5'>


            <div class="offcanvas offcanvas-top " tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel"
                style='height:500px;'>
                <div class="offcanvas-header ">
                    <h5 class="offcanvas-title " id="offcanvasTopLabel">Update Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method='Post' id='update_form'>

                        <label for="ProductName">
                            ProductName
                        </label>
                        <input required type="text" id='ProductName' class='form-control w-25 mb-4'>

                        <!-- <label for="formFile" class="form-label">Default file input example</label> -->
                        <!-- <input required class="form-control w-25 mb-4" type="file" id="formFile"> -->
                        <label for="ProductPrice">
                            Price
                        </label>
                        <input required type="text" id='ProductPrice' class='form-control w-25 mb-4'>

                        <label for="Desc">Comments</label>
                        <textarea class="form-control w-50 mb-4" placeholder="Leave a comment here"
                            id="Desc"></textarea>

                        <button type='submit' class=' btn btn-outline-secondary'>Click</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Product -->
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">Add Products</button>

        <div class="offcanvas offcanvas-bottom " tabindex="-1" style='height:700px;' id="offcanvasBottom"
            aria-labelledby="offcanvasBottomLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasBottomLabel">Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body offcanvas-lg">
                <form method='Post' id='AddProduct'>

                    <label for="Name">
                        ProductName
                    </label>
                    <input required type="text" id='Name' class='form-control w-25 mb-4'>

                    <label for="formFile" class="form-label">Please Add imgbb Link</label>
                    <input required class="form-control w-25 mb-4" type="file" id="formImage">
                    <label for="Price">
                        Price
                    </label>
                    <input required type="text" id='Price' class='form-control w-25 mb-4'>

                    <label for="Description">Comments</label>
                    <textarea class="form-control w-50 mb-4" placeholder="Leave a comment here"
                        id="Description"></textarea>

                    <button type='submit' class=' btn btn-outline-secondary'>Click</button>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>
    $(document).ready(function() {
        let pointer = '';
        $.ajax({
            type: "POST",
            url: "../../includes/db/ProductDB.php",
            data: "data",
            dataType: "JSON",
            success: function(response) {
                console.log(response);
                let productHtml = '';
                $.each(response, function(i, item) {
                    productHtml += /*html */ `
                        <tr>
                        <th>${item.product_id}</th>
                        <td>${item.product_name}</td>
                        <td>${item.product_image}</td>
                        <td>${item.product_price}</td>
                        <td>${item.Description}</td>
                        <td><button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
                        aria-controls="offcanvasTop" id='updatebtn'>Update</button></td>
                        <td><button class='btn btn-danger' id='Removebtn'>Remove</button></td>


                        </tr>
                        `
                })
                $('#table_body').empty().append(productHtml)
            }
        });
        $('#table_body').on('click', '#updatebtn', function(e) {
            const row = $(this).closest('tr');
            pointer = row.find('th').text().trim();

            const ProductNames=row.find('td').eq(0).text().trim();
            const ProductPrice=row.find('td').eq(2).text().trim();
            const ProductDescription=row.find('td').eq(3).text().trim();

            $('#ProductName').val(ProductNames);
            $('#ProductPrice').val(ProductPrice);
            $('#Desc').val(ProductDescription)

        });

        $('#update_form').submit(function(e) {
            e.preventDefault()


            const FormData = {
                PrName: $('#ProductName').val(),
                Pirce: $('#ProductPrice').val(),
                Desc: $('#Desc').val(),
                id: pointer
            }
            console.log(FormData);

            $.ajax({
                type: "POST",
                url: "../../includes/db/CURD.php",
                data: FormData,
                dataType: "json",
                success: function(response) {
                    console.log(FormData);
                    console.log(response);
                    if (response.status === 'success') {
                        location.reload(); // Refresh the page after successful addition
                    } else {
                        alert(response.message); // Optionally show an error message
                    }


                }
            });

        })
        $('#AddProduct').submit(function(e) {
            e.preventDefault()
            const Data = {
                Name: $('#Name').val(),
                Image: $('#formImage').val(),
                pirce: $('#Price').val(),
                Description: $('#Description').val()
            }

            $.ajax({
                type: "post",
                url: "../../includes/db/CURD.php",
                data: Data,
                dataType: "JSON",
                success: function(response) {

                    console.log(Data);
                    if (response.status === 'success') {
                        location.reload(); // Refresh the page after successful addition
                    } else {
                        alert(response.message); // Optionally show an error message
                    }

                }
            });
        })
        $('#table_body').on('click', '#Removebtn', function(event) {
            event.preventDefault()
            let row = $(this).closest('tr');
            pointer = row.find('th').text().trim();
            $.ajax({
                type: "POST",
                url: "../../includes/db/CURD.php",
                data: {
                    pointer: pointer
                },
                dataType: "json",

                success: function(response) {
                    console.log('Full response:', response);

                    if (response.status === 'success') {
                        location.reload(); // Refresh the page after successful addition
                    } else {
                        alert(response.message); // Optionally show an error message
                    }
                }

            });
        });
       

    })
    </script>
</body>

</html>