<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <title>AdminLTE 3 | Top Navigation</title>
  <?php $this->load->view("includes/head.php") ?>

  <style type="text/css">
        .loader {
            height: 30px;
            text-align: center;
            width:150px;
            margin:0 auto;
            padding:10px;
            display: none;
        }
        div.scrollmenu{
          background-color: #C2C6C5;
          overflow: auto;
          white-space: nowrap;
        }
        div.scrollmenu a{
          display: inline-block;
          color: white;
          text-align: center;
          padding: 14px;
          text-decoration: none;
        }
        div.scrollmenu a:hover{
          background-color: #8AA49E;
        }
    </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?php $this->load->view("includes/user/top-nav.php") ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Toko Sepatu <small>v.0.1</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!--<li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Top Navigation</li>-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="container">
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="col-12">
                <img id="imgresult0" src="<?= base_url(); ?>assets/dist/img/prod-1.jpg" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img id="imgresult1" src="<?= base_url(); ?>assets/dist/img/prod-1.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img id="imgresult2" src="<?= base_url(); ?>assets/dist/img/prod-2.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img id="imgresult3" src="<?= base_url(); ?>assets/dist/img/prod-3.jpg" alt="Product Image"></div>
                <div class="product-image-thumb" ><img id="imgresult4" src="<?= base_url(); ?>assets/dist/img/prod-4.jpg" alt="Product Image"></div>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 name="namaproduk" class="namaproduk my-3"></h3>
              <a href="#">
              	<h5 name="merkproduk"></h5>
              </a>
              <p name="deskripsi"></p>

              <div class="bg-gray py-2 px-3 mt-4">
                <h2 name="hargaproduk" class="mb-0">
                  $80.00
                </h2>
              </div>

              <div class="mt-4">
                <div class="btn btn-primary btn-lg btn-flat">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                  Add to Cart
                </div>

                <div class="btn btn-default btn-lg btn-flat">
                  <i class="fas fa-heart fa-lg mr-2"></i> 
                  Add to Wishlist
                </div>
              </div>

              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus. </div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <?php $this->load->view("includes/footer.php") ?>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<?php $this->load->view("includes/js.php") ?>

<script type="text/javascript">
	$(document).ready(function(){
		tampil_produk();
	});

	function tampil_produk(idp)
	{
		var idp = <?= $idproduk; ?>
    //Ajax Load data from ajax
    $.ajax({
    	url : "<?= base_url('Home/tampilProduk')?>/" + idp,
    	type: "GET",
    	dataType: "JSON",
    	success: function(data)
    	{
    		var sc ="<?= base_url(); ?>assets/image-produk/";

    		//$('[name="idp"]').val(data.id_detailproduk);
    		$('[name="namaproduk"]').text(data.nama_produk);
    		$('[name="merkproduk"]').text(data.nama_merk);
    		$('[name="hargaproduk"]').text("Rp."+data.harga_produk);

        /*$('[name="detailproduk"]').val(data.produk_detailproduk);
        $('[name="size39"]').val(data.size39);
        $('[name="size40"]').val(data.size40);
        $('[name="size41"]').val(data.size41);
        $('[name="size42"]').val(data.size42);
        $('[name="size43"]').val(data.size43);
        $('[name="size44"]').val(data.size44);
        $('[name="image1"]').val(data.gambar1);
        $('[name="image2"]').val(data.gambar2);
        $('[name="image3"]').val(data.gambar3);
        $('[name="image4"]').val(data.gambar4);*/
        //$('#gambar1').prop('value',fp+data.gambar1);
        $('#imgresult0').prop('src',sc+data.gambar1);
        $('#imgresult1').prop('src',sc+data.gambar1);
        $('#imgresult2').prop('src',sc+data.gambar2);
        $('#imgresult3').prop('src',sc+data.gambar3);
        $('#imgresult4').prop('src',sc+data.gambar4);
        $('[name="deskripsi"]').text(data.deskripsi_detailproduk);
    		//$('[name="dob"]').datepicker('update',data.dob);
            //$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            //$('.modal-title').text('Edit Produk'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	alert('Error get data from ajax');
        }
    });
}

</script>

</body>
</html>