<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo ROOT ?>cpanel">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="mx-3 sidebar-brand-text">SB Admin <sup>2</sup></div>
	</a>

	<!-- Divider -->
	<hr class="my-0 sidebar-divider">
	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="<?php echo ROOT ?>cpanel">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">
		<li class="nav-item">
			<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#managerOrder"
			aria-expanded="true" aria-controls="managerOrder">
			<i class="fa-solid fa-list-check"></i>
			<span>Quản lý đơn hàng</span>
		</a>
		<div id="managerOrder" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="py-2 bg-white rounded collapse-inner">
				<a class="collapse-item" href="<?php echo ROOT ?>order">Liệt kê đơn hàng</a>
			</div>
		</div>
	</li>
		<!-- Nav Item - Pages Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
			aria-expanded="true" aria-controls="collapseTwo">
			<i class="fa-solid fa-bars"></i>
			<span>Categories</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="py-2 bg-white rounded collapse-inner">
				<a class="collapse-item" href="<?php echo ROOT ?>categories">Liệt kê</a>
				<a class="collapse-item" href="<?php echo ROOT ?>categories/add_category">Thêm</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Utilities Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="<?php echo ROOT ?>assets/admin/#" data-toggle="collapse" data-target="#collapseUtilities"
			aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fa-solid fa-sliders"></i>
			<span>Banner</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
		data-parent="#accordionSidebar">
		<div class="py-2 bg-white rounded collapse-inner">
			<a class="collapse-item" href="<?php echo ROOT ?>banner">Liệt kê banner</a>
			<a class="collapse-item" href="<?php echo ROOT ?>banner/add_banner">Thêm banner</a>
		</div>
	</div>
</li>
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
	aria-expanded="true" aria-controls="#collapseOne">
	<i class="fa-solid fa-user"></i>
	<span>Admin</span>
</a>
<div id="collapseOne" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="py-2 bg-white rounded collapse-inner">
	<a class="collapse-item" href="<?php echo ROOT ?>admin">Liệt kê admin</a>
	<a class="collapse-item" href="<?php echo ROOT ?>admin/add_admin">Thêm admin</a>
	<a class="collapse-item" href="<?php echo ROOT ?>admin/rule">Liệt kê Rule</a>
	<a class="collapse-item" href="<?php echo ROOT ?>admin/add_rule">Thêm Rule</a>
</div>
</div>
</li>
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
	aria-expanded="true" aria-controls="#collapseProduct">
	<i class="fa-solid fa-box"></i>
	<span>Sản phẩm</span>
</a>
<div id="collapseProduct" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="py-2 bg-white rounded collapse-inner">
	<a class="collapse-item" href="<?php echo ROOT ?>product">Liệt kê sản phẩm</a>
	<a class="collapse-item" href="<?php echo ROOT ?>product/add_product">Thêm sản phẩm</a>
</div>
</div>
</li>
<li class="nav-item">
	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#coupons"
	aria-expanded="true" aria-controls="#coupons">
	<i class="fa-solid fa-percent"></i>
	<span>Coupons</span>
</a>
<div id="coupons" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="py-2 bg-white rounded collapse-inner">
	<a class="collapse-item" href="<?php echo ROOT ?>coupon">Liệt kê coupons</a>
	<a class="collapse-item" href="<?php echo ROOT ?>coupon/add_coupon">Thêm coupon</a>
</div>
</div>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
	<button class="border-0 rounded-circle" id="sidebarToggle"></button>
</div>
</ul>
    <!-- End of Sidebar -->