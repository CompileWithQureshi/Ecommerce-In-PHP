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
            <h1 class='text-center border-bottom'>User List</h1>
        </div>
        <div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Zip Code</th>
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
                url: "../../includes/db/UserList.php",
                data: "data",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    let tableHtml = '';

                    // Loop through response to create rows
                    $.each(response, function(i, item) {
                        tableHtml += `
                            <tr>
                                <th scope="row">${item.id}</th>
                                <td>${item.firstName} </td>
                                <td>${item.lastName}</td>
                                <td>${item.email}</td>
                                <td>${item.city}</td>
                                <td>${item.zipCode}</td>
                            </tr>
                        `;
                    });

                    // Append rows to the table body
                    $('#table_body').html(tableHtml);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        });
    </script>
</body>

</html>
