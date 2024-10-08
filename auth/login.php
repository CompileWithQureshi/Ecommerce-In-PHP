<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Page</title>
    <style>
        body {
            display: grid;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class='container card p-5'>
    <div id="message"></div> 
        <h2>Login Page</h2>
        <form id='login' method='POST'>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="on" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#login').on('submit', function(event) {
                event.preventDefault();
                
                let loginData = {
                    email: $('#email').val(),
                    password: $('#password').val()
                };
                
                $.ajax({
                    type: "POST",
                    url: "../includes/db/loginQu.php",
                    data: loginData,
                    dataType: "json", // Expect a JSON response
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = '../views/public/main.php';
                            
                             // Redirect to main page
                            const userString=JSON.stringify(loginData);
                            console.log(userString);
                            localStorage.setItem('user',userString)
                             
                             
                        } else {
                            $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $('#message').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>
