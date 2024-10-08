 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bootstrap Icons (Optional) -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <title>logout</title>
 </head>

 <body>

     <div class='dataList w-100 h-100 text-center align-items-center'>
        <h1>Order sucessfully  </h1>
     </div>



     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

     <script>
     $(document).ready(function() {
         let user = localStorage.getItem('user')
         let userData = JSON.parse(user)
         let email = userData.email;
         console.log(email);

         $.ajax({
             type: "POST",
             url: "../includes/db/combineDB.php",

             data: {
                 email: email
             },
             dataType: "json",
             success: function(response) {
                 // Check if the response contains data
                 let allCardsHtml=''
                 if (response.data && response.data.length > 0) {
                     
                    response.data.forEach(function(item) {
                let fullName = item.firstName + ' ' + item.lastName;
                        
                allCardsHtml += /*html*/ `
                    <div class="card border-success mb-3" >
                        <div class="card-header fs-3 fw-normal">Name: ${fullName}
                        <h5 class="card-title fs-3 fw-normal">Email: ${item.email}</h5>
                        </div>
                        <div class="card-body text-success">
                            
                            <h5> City: ${item.city}</h5>
                            <h5> zipCode: ${item.zipCode}</h5>

                            <ul class="list-unstyled">
                            <li class='card-text fs-5'>Item: ${item.product_name}</li>
                            <li class='card-text fs-5' >Description: ${item.product_description}</li>
                                <li class='card-text fs-5'>Quantity: ${item.quantity}</li>
                                <li class='card-text fs-5'>Price: ${item.price}</li>
                            </ul>
                            <p class='card-text fw-bold fs-4'>Total Cost: ${item.total_cost}</p>
                        </div>
                    </div>
                `;
            });

            
            $('.dataList').empty().html(allCardsHtml);
        } else {
                     console.log("No data received");
                 }
             },
            
         });

     });
     </script>

 </body>

 </html>




