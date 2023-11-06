<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo ROOT ?>admin">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">
	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="<?php echo ROOT ?>admin">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">
		
		<!-- Nav Item - Pages Collapse Menu -->
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
			aria-expanded="true" aria-controls="collapseTwo">
			<i class="fa-solid fa-bars"></i>
			<span>Categories</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
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
		<div class="bg-white py-2 collapse-inner rounded">
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
<div class="bg-white py-2 collapse-inner rounded">
	<a class="collapse-item" href="<?php echo ROOT ?>admin">Liệt kê admin</a>
	<a class="collapse-item" href="<?php echo ROOT ?>admin/add_admin">Thêm admin</a>
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
<div class="bg-white py-2 collapse-inner rounded">
	<a class="collapse-item" href="<?php echo ROOT ?>product">Liệt kê sản phẩm</a>
	<a class="collapse-item" href="<?php echo ROOT ?>product/add_product">Thêm sản phẩm</a>
</div>
</div>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
	<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
    <!-- End of Sidebar -->