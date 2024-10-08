<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Signup Form</title>
    <style>
    body {
        display: flex;
        align-items: center;
        height: 100vh;
    }

    .card_container {
        width: 60%;
    }

    .inputBtn {
        width: 250px !important;
    }
    .adminbtn{
        text-decoration: none;
        color:white;
    }
    </style>
</head>

<body>
    <div class='container card_container card p-5 rounded-4'>
        <div class='d-flex justify-content-between'>
        <div class=' message'></div>
        <button type='submit' id='AdminLogin' class='btn btn-dark' >
            <a href="./views/admin/AdminLogin.php" class='adminbtn'>Admin</a>
        </button>
        </div>
        
        <div class='text-center mb-3'>
            <h1>Signup Form</h1>
        </div>
        <form class="row g-3" id='create-form' method="post" action='./auth/login.php'>

            <div class="col-md-4">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control inputBtn" id="firstname" name='firstName' required>
            </div>
            <div class="col-md-4">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control inputBtn" id="lastname" name='lastName' required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                    <input type="email" name='email' class="form-control inputBtn w-50" id="email" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control inputBtn" name='city' id="city" required>
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control inputBtn" name='password' id="password" required>
            </div>
            <div class="col-md-3">
                <label for="zipCode" class="form-label">Zip</label>
                <input type="text" class="form-control inputBtn" name='zipCode' id="zipCode" required>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input checkBox" type="checkbox" value="" id="invalidCheck2" required>
                    <label class="form-check-label" for="invalidCheck2">
                        Agree to terms and conditions
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
            <strong>OR</strong>
            <a href="auth/login.php" class='text-decoration-none btn btn-primary ' style="width: max-content;">LOGIN</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        

        })
        $('#create-form').submit(function(event) {
            event.preventDefault();

            let formData = {
                firstName: $('#firstname').val(),
                lastName: $('#lastname').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                city: $('#city').val(),
                zipCode: $('#zipCode').val(),
            }
            console.log(formData);


            $.ajax({
                type: "POST",
                url: "includes/db/singUpDB.php", 
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('check');
                    console.log(response);
                    if (response.status === 'error') {
                        
                        $('.message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }else if (response.status === 'success') {
                        console.log('check');
                        
                   
                        $('.message').html('<div class="alert alert-success">' + response.message + '</div>');
                        window.location.href = $('#create-form').attr('action');

                    }


                    // Handle the response
                    //   alert("Data submitted successfully: " + response);
                },
                error: function(xhr, status, error) {
                    
                    // console.error('XHR Response:', xhr.responseText); // Full response
                }


            });
        });
    </script>
</body>

</html>