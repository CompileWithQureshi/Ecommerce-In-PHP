<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}
?>

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
    body{
        display:flex;
        justify-content:center;
        align-items:center;
        height: 100vh;
    }
    </style>
<body>


<form class='w-50 border border-2 p-4 rounded-3 text-start'   id='AdminLogin'>
<h1>Admin</h1>
<div class='message'></div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control" id="Password" required >
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required name='password'>
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function(){
            let Admin='Admin@email.com';
            let Adminpass='Admin123';


            
            $('#AdminLogin').submit(function(e){
            e.preventDefault()
                
            let email=$('#email').val();
            let password = $('#Password').val();

            console.log(email);

            console.log(password);

            if (email==Admin && password == Adminpass) {
                console.log('correct password');
                
                window.location.href = 'AdminMain.php';
            }else{
                console.log('Incorrect password and email');
                $('.message').empty().html(
                    `<div class='btn btn-outline-danger'>${'Incorrect  email or password '}</div>`
                )
                
            }

            
            })
        })
        </script>

</body>
</html>


 