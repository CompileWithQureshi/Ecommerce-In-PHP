<!-- navbar.php -->
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Nav bar</button>

<div class="offcanvas offcanvas-start d-flex flex-column align-items-center justify-content-between" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class='text-start align-self-center'>
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="Header">Admin Panel</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mt-5">
      <ul class='list-unstyled'>
      <li>
          <button type='submit' class='btn btn-outline-primary m-2' style='width:200px;'>
            <a class='text-decoration-none text-dark' href="AdminMain.php"> HOME</a>
          </button>
        </li>
        <li>
          <button type='submit' class='btn btn-outline-primary m-2' style='width:200px;'>
            <a class='text-decoration-none text-dark' href="UserList.php">User List</a>
          </button>
        </li>
        <li>
          <button type='submit' class='btn btn-outline-primary m-2' style='width:200px;'>
            <a class='text-decoration-none text-dark' href="Order.php">Order List</a>
          </button>
        </li>
        <li>
          <button type='submit' class='btn btn-outline-primary m-2' style='width:200px;'>
            <a class='text-decoration-none text-dark' href="Product_list.php">Product List</a>
          </button>
        </li>
      </ul>
    </div>
  </div>
  <div class='w-100 bg-secondary h-25'>
    footer
  </div>
</div>
