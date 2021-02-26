<!doctype html>
<html lang="en">
  <head>

    <!-- Head -->
    <?php $this->load->view("includes/head.php") ?>
    <title>DW Admin Edit by Koes26</title>
</head>
<body>
	<div class="container">
		<div class="row vh-100 d-flex justify-content-center align-items-center auth my-4">
			<div class="col-md-7 col-lg-5">
				<div class="card">
					<div class="card-body">
						<h3 class="mb-5">SIGN UP</h3>
						<form action="<?= base_url('Home/daftarUser');?> " method="POST">
							<div class="form-group">
								<input type="text" name="username" class="form-control" placeholder="Username">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
							<div class="form-group">
								<button class="btn btn-linear-primary btn-rounded px-5">Create an account</button>
							</div>
						</form>
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