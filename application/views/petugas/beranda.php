<!doctype html>
<html lang="en">
  <head>

    <!-- Head -->
    <?php $this->load->view("includes/head.php") ?>
    <title>Perpustaan by Koes26 </title>
</head>
<body>
  
  <!--Header Top -->
  <?php $this->load->view("includes/header-top.php") ?>

	<!--Sidebar-->
	<?php $this->load->view("includes/petugas/sidebar-petugas.php") ?>
	<div class="sidebar-overlay"></div>

	<!--Content Start-->
	<div class="content transition">
		<div class="container-fluid dashboard">
			<h3>Dashboard</h3>
			<h3><?= $this->session->userdata('nama');?></h3>
		
			<div class="row">

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="las la-inbox icon-home bg-primary text-light"></i>
								</div>
								<div class="col-8">
									<p>Revenue</p>
									<h5>$65</h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="las la-clipboard-list icon-home bg-success text-light"></i>
								</div>
								<div class="col-8">
									<p>Orders</p>
									<h5>3000</h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="las la-chart-bar  icon-home bg-info text-light"></i>
								</div>
								<div class="col-8">
									<p>Sales</p>
									<h5>5500</h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4 d-flex align-items-center">
									<i class="las la-id-card  icon-home bg-warning text-light"></i>
								</div>
								<div class="col-8">
									<p>Employes</p>
									<h5>256</h5>
								</div>
							</div>
						</div>
					</div>

				</div>
		
				<div class="col-md-6">
					<div class="card">
						<h5 class="card-header">Projects</h5>
						<div class="card-body">
							<div class="row mb-1">
								<div class="col-6 mt-4">
									Server Migration
								</div>
								<div class="col-6 mt-4 text-right">
									20%
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
									aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="row mt-4 mb-1">
								<div class="col-6">
									Sales Tracking
								</div>
								<div class="col-6 text-right">
									40%
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
									aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="row mt-4 mb-1">
								<div class="col-6">
									Customer Database
								</div>
								<div class="col-6 text-right">
									60%
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="60"
									aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="row mt-4 mb-1">
								<div class="col-6">
									Payout Details
								</div>
								<div class="col-6 text-right">
									80%
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
									aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="row mt-4 mb-1">
								<div class="col-6">
									Account Setup
								</div>
								<div class="col-6 text-right">
									Complete!
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
									aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
		
					<div class="row">
						<div class="col-6">
							<div class="card bg-primary">
								<div class="card-body">
									<p>Primary</p>
									<p class="mb-0">#3B82F6</p>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="card bg-success">
								<div class="card-body">
									<p>Success</p>
									<p class="mb-0">#10B981</p>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="card bg-info">
								<div class="card-body">
									<p>Info</p>
									<p class="mb-0">#36B9CC</p>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="card bg-warning">
								<div class="card-body">
									<p class="text-light">Warning</p>
									<p class="text-light mb-0">#F59E0B</p>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="card bg-danger">
								<div class="card-body">
									<p>Danger</p>
									<p class="mb-0">#EF4444</p>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="card bg-secondary">
								<div class="card-body">
									<p>Secondary</p>
									<p class="mb-0">#858796</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card">
						<h5 class="card-header">Illustrations</h5>
						<div class="card-body">
							<img src="assets/images/undraw_responsive_6c8s.svg" class="img-fluid p-5">
							<p class="mb-4">Add some quality, svg illustrations to your project courtesy of <a
									href="https://undraw.co" target="_blank">unDraw</a>, a constantly updated collection of beautiful
								svg images that you can use completely free and without attribution!</p>
		
							<a href="https://undraw.co" target="_blank">Browse Illustrations on unDraw →</a>
						</div>
					</div>
		
					<div class="card">
						<h5 class="card-header">
							Development Approach
						</h5>
						<div class="card-body">
							<p class="mb-3 mt-4">DWAdmin makes extensive use of Bootstrap 4 utility classes in order to reduce CSS
								bloat and poor page performance. Custom CSS classes are used to create custom components and custom
								utility classes.</p>
							<p>Before working with this theme, you should become familiar with the Bootstrap framework, especially
								the utility classes.</p>
						</div>
					</div>
				</div>
			</div>
		
		</div>

	</div>

	<!-- Footer -->
	<?php $this->load->view("includes/footer.php") ?>

	<!-- Loader -->
	<div class="loader">
		<div class="spinner-border text-light" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	
	<div class="loader-overlay"></div>

	<!-- Javascipt-->
	<?php $this->load->view("includes/js.php") ?>
 </body>
</html>