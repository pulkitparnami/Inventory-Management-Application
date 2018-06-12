<nav class="admin-nav">
  <div class="container">
    <div class="row">
      <div class="col-md-6 adnav-left">
        <ul class="nav-ul">
          <li><a href=<?php echo REL.'/admin/inventory.php';?>>Inventory</a></li>
          <li>
            <a href="">Customers</a>
            <ul class="ddown-menu">
              <li><a href="<?php echo REL.'/admin/register.php';?>">Register Customer</a></li>
              <li><a href="<?php echo REL.'/admin/users-list.php';?>">Customer List</a></li>
              <li><a href="<?php echo REL.'/admin/order-list.php';?>">Order List</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <div class="col-md-6 adnav-right">
        <ul class="nav-ul">
          <li class="nav-src-product">
            <?php include(ROOT.'/admin/templates/search-product-form.php'); ?>
          </li>

          <li class="nav-src-product">
            <?php include(ROOT.'/admin/templates/search-customer-form.php'); ?>
          </li>

      </ul>
      </div>
    </div>
  </div>
</nav>