<div class='container h-100'>
    <div class='card-group row row-cols-lg-6 m-5' id='cards'>
        <!-- Cards will be dynamically inserted here -->
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "../../includes/db/productDB.php",
        dataType: "json",
        success: function(response) {
            console.log(response);

            // Clear existing cards
            $('#cards').empty();

            // Create variable to hold all card HTML
            let cardHtml = '';

            // Loop through each product and generate the HTML
            response.forEach((data) => {
                cardHtml += /*html */ `
                        <div class='col-md-5 mb-3 ' style='width:300px'  >
                            <div class='card p-2'  style='height:370px !important;over-flow=hidden;'>
                                <img src="${data.product_image}" class='card-img ' alt='img' style="height:100px;width=100px">
                                <div class='card-body d-flex flex-column justify-content-between align-items-between'>
                                    <h5 class='card-title'>${data.product_name}</h5>
                                    <p class="card-text">PRICE: $ ${data.product_price}</p>
                                    <p class="card-text"><small class="text-body-secondary">${data.Description}</small></p>
                                    <button type="button" class="btn btn-outline-info" id='Addbtn' 
                                    data-name="${data.product_name}" data-price="${data.product_price} 
                                      "data-image="${data.product_image}" data-description="${data.Description}"
                                      data-id="${data.product_id}"
                                      >Add</button>
                                </div>
                            </div>
                        </div>
                    `;
            });

            // Append all cards to the container
            $('#cards').append(cardHtml);

        },
        error: function(error) {
            console.error("Error fetching data:", error);
        }
    });

    $(document).on('click','#Addbtn',function(){

        const productCart={
            id:$(this).data('id'),
            name:$(this).data('name'),
            image:$(this).data('image'),
            description:$(this).data('description'),
            price:$(this).data('price')

        }
       
        
        AddToCart(productCart)
        // console.log(productCart.id);
    })
    
});
</script>