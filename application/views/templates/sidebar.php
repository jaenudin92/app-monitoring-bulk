<?php 
	$id = $this->session->userdata('id');
	$datauser = $this->db->query("select nama_lengkap,level,foto from tbl_user where id = '$id' ")->row_array();
 ?>

<body>
	<input type="hidden" id="levellogin" value="<?= $datauser['level']; ?>">
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->

			<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
				<div class="app-brand demo">
					<a href="<?= base_url(); ?>" class="app-brand-link">
						<span class="app-brand-logo demo">
							<img src="<?= base_url(); ?>assets/img/logo.png" alt="Logo" style="width: 4.3vw;">
						</span>
						<span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">RND</span>
					</a>
				</div>

				<div class="menu-inner-shadow"></div>
				<ul class="menu-inner py-1">
					<!-- Dashboard -->
					<li class="menu-item" id="menu-a">
						<a href="<?= base_url(); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-home-circle"></i>
							<div data-i18n="Analytics">Dashboard</div>
						</a>
					</li>
					<!-- MENU -->
					<li class="menu-header small text-uppercase"><span class="menu-header-text">MENU</span></li>
					<!-- Cards -->
					<?php if ($datauser['level'] == 'Admin') { ?>
					<li class="menu-item" id="menu-b">
						<a href="<?= base_url('User'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-user"></i>
							<div data-i18n="Boxicons">Users</div>
						</a>
					</li>
					<?php };?>
					<?php if ($datauser['level'] == 'Admin' || $datauser['level'] == 'Leader') { ?>
					<li class="menu-item" id="menu-c">
						<a href="<?= base_url('Brand'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-crown"></i>
							<div data-i18n="Boxicons">Brand</div>
						</a>
					</li>

					<li class="menu-item" id="menu-d">
						<a href="<?= base_url('Itemgroup'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-box"></i>
							<div data-i18n="Boxicons">Item Group</div>
						</a>
					</li>

					<li class="menu-item" id="menu-e">
						<a href="<?= base_url('Koordinat'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-map"></i>
							<div data-i18n="Boxicons">Koordinat</div>
						</a>
					</li>

					<li class="menu-item" id="menu-f">
						<a href="<?= base_url('Product'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bxl-product-hunt"></i>
							<div data-i18n="Boxicons">Produk</div>
						</a>
					</li>
					<?php };?>
					<li class="menu-item" id="menu-g">
						<a href="<?= base_url('Product/Inputproduct'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-edit-alt"></i>
							<div data-i18n="Boxicons">Input Product</div>
						</a>
					</li>

					<li class="menu-item">
						<a href="<?= base_url('home/logout'); ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-power-off"></i>
							<div data-i18n="Boxicons"><span class="fa fa-plus"></span> Logout</div>
						</a>
					</li>
				</ul>
			</aside>
			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Navbar -->

				<nav
				class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
				id="layout-navbar"
				>
				<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
					<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
						<i class="bx bx-menu bx-sm"></i>
					</a>
				</div>

				<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
					<!-- Search -->
					<!-- <div class="navbar-nav align-items-center">
						<div class="nav-item d-flex align-items-center">
							<i class="bx bx-search fs-4 lh-0"></i>
							<input
							type="text"
							class="form-control border-0 shadow-none"
							placeholder="Search..."
							aria-label="Search..."
							/>
						</div>
					</div> -->
					<!-- /Search -->

					<ul class="navbar-nav flex-row align-items-center ms-auto">
						<!-- Place this tag where you want the button to render. -->
						<li class="nav-item lh-1 me-3">
							<?= $datauser['nama_lengkap']; ?>
						</li>

						<!-- User -->
						<li class="nav-item navbar-dropdown dropdown-user dropdown">
							<a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
								<div class="avatar avatar-online">
									<img src="<?= base_url(); ?>assets/img/avatars/<?= $datauser['foto']; ?>" alt class="w-px-40 h-auto rounded-circle" />
								</div>
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
								<li>
									<a class="dropdown-item" href="#">
										<div class="d-flex">
											<div class="flex-shrink-0 me-3">
												<div class="avatar avatar-online">
													<img src="<?= base_url(); ?>assets/img/avatars/<?= $datauser['foto']; ?>" alt class="w-px-40 h-auto rounded-circle" />
												</div>
											</div>
											<div class="flex-grow-1">
												<span class="fw-semibold d-block"><?= $datauser['nama_lengkap']; ?></span>
												<small class="text-muted"><?= $datauser['level']; ?></small>
											</div>
										</div>
									</a>
								</li>
								<li>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a class="dropdown-item" href="<?= base_url('home/logout'); ?>">
										<i class="bx bx-power-off me-2"></i>
										<span class="align-middle">Log Out</span>
									</a>
								</li>
							</ul>
						</li>
						<!--/ User -->
					</ul>
				</div>
			</nav>

			<!-- / Navbar -->