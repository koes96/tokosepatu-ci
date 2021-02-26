<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//application/views/posts.php
?>
<?php $assets = base_url("assets/image-produk/"); ?>
<?php foreach ($posts as $post):?>
    <div class="col-md-4 col-xs-6 d-flex align-items-stretch">
      <div class="card bg-light">
        <div class="card-body pt-0">
            <div class="col p-4 d-flex flex-column position-static">
              <h2 class="lead"><b><?= $post->nama_merk; ?></b></h2>
              <p class="text-muted text-sm"><?= $post->nama_produk; ?></p>
              <h2 class="lead"><b>Harga: Rp.<?= $post->harga_produk; ?></b></h2>
          </div>
          <div class="col p-4 d-flex flex-column position-static text-center">
              <img src="<?= $assets,$post->gambar1 ?>" alt="" class="img-circle img-fluid">
          </div>
      </div>
      <div class="card-footer">
          <div class="text-right">
            <form method="POST">
              <input type="hidden" name="idProduk" value="<?= $post->id_produk; ?>">
              <a href="<?= base_url(); ?>Home/Keranjang" class="btn btn-sm bg-success">
                <i class="fas fa-medkit"></i> Keranjang
            </a>
            <a href="<?= base_url(); ?>Home/DetailProduk" class="btn btn-sm btn-warning">
                <i class="fas fa-shopping-cart"></i> Shop
            </a>
        </form>
    </div>
  </div>
</div>
</div>
<?php endforeach;?>