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
    <div class="content">
      <div class="container">
        <!-- Carousel -->
        <div class="col-xs-12 d-flex align-items-stretch">
          <div id="carousel1" class="carousel slide" data-ride="carousel" data-pause="hover">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="">
                <img src="<?= base_url(); ?>assets/dist/img/photo1.png" alt="" class="d-block w-100" style="width: 100%; height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                  <h3></h3>
                </div>
              </a>
              </div>
              <div class="carousel-item">
                <a href="">
                <img src="<?= base_url(); ?>assets/dist/img/photo2.png" alt="" class="d-block w-100" style="width: 100%; height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                  <h3></h3>
                </div>
              </a>
              </div>
              <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div><br>
        <!-- End Carousel -->
        <!-- Top Produk -->
        <div class="owl-carousel owl-theme" >
          <div class="item">
            <img src="<?= base_url(); ?>assets/dist/img/AdminLTElogo.png" alt="" class="img-circle img-fluid">
          </div>
          <div class="item">
            <img src="<?= base_url(); ?>assets/dist/img/AdminLTElogo.png" alt="" class="img-circle img-fluid">
          </div>
          <div class="item">
            <img src="<?= base_url(); ?>assets/dist/img/AdminLTElogo.png" alt="" class="img-circle img-fluid">
          </div>
          <div class="item">
            <img src="<?= base_url(); ?>assets/dist/img/AdminLTElogo.png" alt="" class="img-circle img-fluid">
          </div>
          <div class="item">
            <img src="<?= base_url(); ?>assets/dist/img/AdminLTElogo.png" alt="" class="img-circle img-fluid">
          </div>
          <div class="item">
            <img src="<?= base_url(); ?>assets/dist/img/AdminLTElogo.png" alt="" class="img-circle img-fluid">
          </div>
          <div class="item">
            <img src="<?= base_url(); ?>assets/dist/img/AdminLTElogo.png" alt="" class="img-circle img-fluid">
          </div>
          <div class="item">
            <img src="<?= base_url(); ?>assets/dist/img/AdminLTElogo.png" alt="" class="img-circle img-fluid">
          </div>
        </div>
        <!-- End Top Produk -->
        <div class="row d-flex align-items-stretch" id="posts-infinite">
          <?php $assets = base_url("assets/image-produk/"); ?>
          <?php foreach ($posts as $post):?>
            <div class="col-md-4 col-sm-6 col-xs-6 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-body pt-0">
                    <div class="col p-4 d-flex flex-column position-static">
                      <h2 class="lead"><b><?= $post->nama_merk; ?></b></h2>
                      <p class="text-muted text-sm"><?= $post->nama_produk; ?></p>
                      <h2 class="lead"><b>Harga: Rp.<?= $post->harga_produk; ?></b></h2>
                    </div>
                    <div class="col p-4 d-flex flex-column position-static text-center">
                      <img src="<?= $assets,$post->gambar1; ?>" alt="" class="img-circle img-fluid">
                    </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                      <a href="<?= base_url(); ?>Home/keranjang/<?= $post->id_produk; ?>" class="btn btn-sm bg-success">
                        <i class="fas fa-medkit"></i> Keranjang
                      </a>
                      <a href="<?= base_url(); ?>Home/detailProduk/<?= $post->id_produk; ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-shopping-cart"></i> Shop
                      </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach;?>
        </div>
        <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Loading...</div></div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
    var page = 0;
    var total_pages = <?= $total_pages?>;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            if(page < total_pages) {
                loadData(page);
            }
        }
    });

    /*Load more Function*/
    function loadData(page) {
        $( ".overlay" ).css( "display","block" );
        $.ajax({
            method: "GET",
            url: "<?= base_url()?>Home",
            data: { page: page }
        })
        .done(function( content ) {
            $( ".overlay" ).css( "display","none" );
            $("#posts-infinite").append(content);

        });
    }

</script>
<script type="text/javascript">
  $(document).ready(function(){
    var owl = $('.owl-carousel');
    owl.owlCarousel({
      margin: 10,
      nav: true,
      lazyLoad: true,
      loop: true,
      responsive: {
        0:{
          items:1
        },
        600:{
          items:3
        },
        1000:{
          items:5
        }
      }
    })
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 5000
        });
        <?php
        if ($msg != '') {
        ?>   Toast.fire({
            icon: 'success',
            title: '<?= $msg; ?>'
          })
        <?php
        } ?>
         
      });
</script>
</body>
</html>
