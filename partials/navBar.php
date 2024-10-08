<nav class="navbar bg-body-tertiary ">
    <div class="container d-flex justify-content-center gap-4">
        <a class="navbar-brand">Navbar</a>
        <form class="d-flex justify-content-center gap-2" role="search">
        <input type="text" id="productSearch" class="form-control" placeholder="Search products...">

        </form>



        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight"><i class="bi bi-cart4   p-2 pe-auto ">
                <span class='position-absolute  bg-danger   rounded-circle text-center'
                    style='width:12px;height:12px;top:3px ' id='count'></span></a>
            </i></button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">ADD to Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class=" mb-3" style="max-width: 540px;" id='addCard'>
                  
                </div>
                <div calss='text-end'>
                Total Price:<span class='totalPrice text-end px-2  border border-2'></span>
                <button type="button" class="btn btn-outline-success" id='BuyAll'>BUY</button>
                </div>

                
            </div>
        </div>
    </div>
</nav>

<script>
let cart = []
let totalPrice = 0;
let  cartString ;
let products = [];
$.ajax({
        type: "POST",
        url: "../../includes/db/productDB.php",
        dataType: "json",
        success: function(response) {
            console.log(response);

            // Store fetched products in the products array
            products = response;

            displayProducts(response); // Display all products initially
        },
        error: function(error) {
            console.error("Error fetching data:", error);
        }
    });

    // Function to display products based on the filtered array
    function displayProducts(productsArray) {
        // Clear existing cards
        console.log(productsArray);
        
        $('#cards').empty();

        // Generate and append product cards
        let cardHtml = '';
        productsArray.forEach((data) => {
            cardHtml += /*html */ `
                <div class='col-md-3 mb-3'>
                    <div class='card p-2' style='height:370px !important;overflow:hidden;'>
                        <img src="${data.product_image}" class='card-img ' alt='img' style="height:100px;width=100px">
                        <div class='card-body d-flex flex-column justify-content-between align-items-between'>
                            <h5 class='card-title'>${data.product_name}</h5>
                            <p class="card-text">PRICE: $ ${data.product_price}</p>
                            <p class="card-text"><small class="text-body-secondary">${data.Description}</small></p>
                            <button type="button" class="btn btn-outline-info" id='Addbtn' 
                            data-name="${data.product_name}" data-price="${data.product_price}" 
                            data-image="${data.product_image}" data-description="${data.Description} "
                            data-id="${data.product_id}">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
                `
            ;
        });

        $('#cards').append(cardHtml);
    }

    // Listen for input changes in the search bar
    $('#productSearch').on('input', function() {
        const query = $(this).val().toLowerCase();

        // Filter products based on the query
        const filteredProducts = products.filter((product) =>
            product.product_name.toLowerCase().includes(query) ||
            product.Description.toLowerCase().includes(query)
        );

        // Display the filtered products
        displayProducts(filteredProducts);
    });

    // Event handler for adding products to cart
    $(document).on('click', '#Addbtn', function() {
        const productCart = {
            id: $(this).data('id'),
            name: $(this).data('name'),
            image: $(this).data('image'),
            description: $(this).data('description'),
            price: $(this).data('price')
        };

        

        AddToCart(productCart);
    });

function updateCart() {
    let cartHtml = '';
    totalPrice=0;
    cart.forEach((item) => { // Corrected foreach to forEach
      
        cartHtml += /*html */ `
          <div class="card mb-3" style="max-width: 540px;" >
              <div class="row g-0">
                  <div class="col-md-4">
                      <img src=${item.image} class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                      <div class="card-body">
                          <h5 class="card-title">${item.name}</h5>
                          <p class="card-text">${item.description}</p>
                          <p class="card-text">Quantity: ${item.quantity}</p>
                          <p class="card-text"><small class="text-body-secondary">$${item.price}</small></p>
                          <button type="button" class="btn btn-danger remove-btn" data-id="${item.id}">Remove</button>

                      </div>
                  </div>
              </div>
          </div>`
        ;
        totalPrice += item.price * item.quantity;
    });
    

    $('#addCard').html(cartHtml)
    $('.totalPrice').html(totalPrice)

}

function AddToCart(productCart) {
    const { image, name, description, price,id } = productCart;

    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: id,
            name: name,
            image: image,
            description: description,
            quantity: 1,
            price: parseFloat(price)
        })
        
    }
    updateCart()

}

$(document).on('click', '.remove-btn', function() {
    const itemId = $(this).data('id');
    cart = cart.filter(item => item.id !== itemId);
    updateCart();
});

$(document).on('click','#BuyAll',function(e){
        e.preventDefault()
  let users=localStorage.getItem('user');
  let userObject=JSON.parse(users)
 console.log(cart);
 
  
  $.ajax({
    type: "POST",
    url: "../../includes/db/OrderDB.php",

    data: {
      cartData:JSON.stringify(cart),
      UserData:JSON.stringify(userObject),
      totalCost:totalPrice
    },
    dataType: "json",
    success: function (response) {
        console.log(response);
        
         window.location.href='../../auth/logout.php';
      
    }
  });
  
})


</script>