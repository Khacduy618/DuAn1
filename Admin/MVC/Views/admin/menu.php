 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Tede<sup>Shop</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Chức năng
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
     <li class="nav-item">
         <a class="nav-link" href="index.php">
             <i class="fas fa-fw fa-chart-area"></i>
             <span>Trang chủ</span></a>
     </li>
     <?php } ?>
     <!-- Nav Item - Charts -->
     <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
     <li class="nav-item">
         <a class="nav-link" href="?mod=user">
             <i class="fas fa-fw fa-table"></i>
             <span>Users Management</span></a>
     </li>
     <?php } ?>
     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link" href="?mod=product">
             <i class="fas fa-fw fa-table"></i>
             <span>Products Management</span></a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="?mod=category">
             <i class="fas fa-fw fa-table"></i>
             <span>Categories Management</span></a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="?mod=coupon">
             <i class="fas fa-fw fa-table"></i>
             <span>Coupons Management</span></a>
     </li>
     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->