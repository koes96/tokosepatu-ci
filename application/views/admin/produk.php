<!doctype html>
<html lang="en">
<head>

	<!-- Head -->
	<?php $this->load->view("includes/head.php") ?>
	<title>Toko Sepatu by Koes26 </title>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!--Header Top -->
    <?php $this->load->view("includes/header-top.php") ?>
    <!--Sidebar-->
    <?php $this->load->view("includes/admin/sidebar-admin.php") ?>
    <!-- Main content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>DataTables</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="container-fluid">
          <button class="btn btn-success" onclick="add_produk()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
          <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
          <br />
          <br />
          <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Nama Produk</th>
                <th>Merk Produk</th>
                <th>Harga Produk</th>
                <th style="width:125px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
              <tr>
                <th>Nama Produk</th>
                <th>Merk Produk</th>
                <th>Harga Produk</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div><!-- /.container-fluid -->
      </section>
    </div>
    <!-- /.Main content -->
    <!-- Footer -->
    <?php $this->load->view("includes/footer.php") ?>
  </div>
  <!-- Javascipt-->
  <?php $this->load->view("includes/js.php") ?>
  <script type="text/javascript">
   $(document).ready(function() {
    $('#data-table-basic').DataTable();
  });
</script>
<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
  merk();
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
        	"url": "<?= base_url('Admin/Produk/ajax_list')?>",
        	"type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
          },
          ],

        });

    //datepicker
    $('.datepicker').datepicker({
    	autoclose: true,
    	format: "yyyy-mm-dd",
    	todayHighlight: true,
    	orientation: "top auto",
    	todayBtn: true,
    	todayHighlight: true,  
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
    	$(this).parent().parent().removeClass('has-error');
    	$(this).next().empty();
    });
    $("textarea").change(function(){
    	$(this).parent().parent().removeClass('has-error');
    	$(this).next().empty();
    });
    $("select").change(function(){
    	$(this).parent().parent().removeClass('has-error');
    	$(this).next().empty();
    });

  });

function add_produk()
{
	save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Produk'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable 
    document.getElementById('imgresult1').src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg";
    document.getElementById('imgresult2').src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg";
    document.getElementById('imgresult3').src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg";
    document.getElementById('imgresult4').src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg";
    merk();

  }
function merk()
  {
  // Tampil Merk
  $.ajax({
    url : "<?= base_url('Admin/Produk/ambilmerk')?>",
    type: "GET",
    async: true,
    dataType: "JSON",
    success: function(data)
    {

      var html = '';
      var i;
      for(i=0; i<data.length; i++)
      {
        html += '<option value='+data[i].id_merk+'>'+data[i].nama_merk+'</option>';
      }
      var x = '<option value=>--Pilih Merk--</option>';
      $('#merkproduk').html(x+html);

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Error get data from ajax');
    }
  });
}
function edit_produk(idp)
{
	save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    document.getElementById('imgresult1').src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg";
    document.getElementById('imgresult2').src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg";
    document.getElementById('imgresult3').src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg";
    document.getElementById('imgresult4').src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg";
    //Ajax Load data from ajax
    $.ajax({
    	url : "<?= base_url('Admin/Produk/ajax_edit/')?>/" + idp,
    	type: "GET",
    	dataType: "JSON",
    	success: function(data)
    	{
        var sc ="<?= base_url(); ?>assets/image-produk/";
        var fp ="C:/fakepath/";

    		$('[name="idp"]').val(data.id_detailproduk);
    		$('[name="namaproduk"]').val(data.nama_produk);
    		$('[name="merkproduk"]').val(data.merk_produk);
    		$('[name="hargaproduk"]').val(data.harga_produk);

        $('[name="detailproduk"]').val(data.produk_detailproduk);
        $('[name="size39"]').val(data.size39);
        $('[name="size40"]').val(data.size40);
        $('[name="size41"]').val(data.size41);
        $('[name="size42"]').val(data.size42);
        $('[name="size43"]').val(data.size43);
        $('[name="size44"]').val(data.size44);
        $('[name="image1"]').val(data.gambar1);
        $('[name="image2"]').val(data.gambar2);
        $('[name="image3"]').val(data.gambar3);
        $('[name="image4"]').val(data.gambar4);
        //$('#gambar1').prop('value',fp+data.gambar1);
        $('#imgresult1').prop('src',sc+data.gambar1);
        $('#imgresult2').prop('src',sc+data.gambar2);
        $('#imgresult3').prop('src',sc+data.gambar3);
        $('#imgresult4').prop('src',sc+data.gambar4);
        $('[name="deskripsi"]').val(data.deskripsi_detailproduk);
    		//$('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Produk'); // Set title to Bootstrap modal title

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
           alert('Error get data from ajax');
         }
       });
  }

  function reload_table()
  {
    table.ajax.reload(null,false); //reload datatable ajax 
  }

  function save()
  {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
    	url = "<?= base_url('Admin/Produk/ajax_add')?>";
    } else {
    	url = "<?= base_url('Admin/Produk/ajax_update')?>";
    }

    //var g1 = $('#gambar1').val();
    //var g2 = $('#gambar2').val();
    //var g3 = $('#gambar3').val();
    //var g4 = $('#gambar4').val();
    var form = document.forms.namedItem('formdata');
    var form_data = new FormData(form);

    //form_data.append('gbr1', g1);
    //form_data.append('gbr2', g2);
    //form_data.append('gbr3', g3);
    //form_data.append('gbr4', g4);
    // ajax adding data to database
    $.ajax({
    	url : url,
    	type: "POST",
      data : form_data,
    	dataType: "JSON",
      contentType:false,
      processData:false,
      cache:false,
      success: function(data)
      {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
                $('#modal_form').modal('hide');
                $('#form')[0].reset();
                reload_table();
            }
            else
            {
            	for (var i = 0; i < data.inputerror.length; i++) 
            	{
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            }
                
            /*
              $('#modal_form').modal('hide');
              $('#form')[0].reset();
              reload_table();*/

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
           alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

          }
        });
  }

  function delete_produk(idp)
  {
   if(confirm('Are you sure delete this data?'))
   {
        // ajax delete data to database
        $.ajax({
        	url : "<?= base_url('Admin/Produk/ajax_delete')?>/"+idp,
        	type: "POST",
        	dataType: "JSON",
        	success: function(data)
        	{
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
               alert('Error deleting data');
             }
           });

      }
    }
    function previewImage1()
    {
      document.getElementById("imgresult1").style.display="block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("gambar1").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("imgresult1").src = oFREvent.target.result;
      };
    };
    function previewImage2()
    {
      document.getElementById("imgresult2").style.display="block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("gambar2").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("imgresult2").src = oFREvent.target.result;
      };
    };
    function previewImage3()
    {
      document.getElementById("imgresult3").style.display="block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("gambar3").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("imgresult3").src = oFREvent.target.result;
      };
    };
    function previewImage4()
    {
      document.getElementById("imgresult4").style.display="block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("gambar4").files[0]);
      document.getElementById("imgresult4").display="hidden";

      oFReader.onload = function(oFREvent) {
        document.getElementById("imgresult4").src = oFREvent.target.result;
      };
    };

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
   <div class="modal-dialog modal-xl">
    <div class="modal-content">
     <div class="modal-header">
      <h3 class="modal-title text-left">Produk Form</h3>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <form action="" id="form" name="formdata" class="form-horizontal" enctype="multipart/form-data" method="POST">
      <div class="modal-body form">
       <div class="form-body">
        <div class="row">
          <!-- Form Input Kiri -->
          <div class="col-md-6">
            <input type="hidden" value="" name="idp"/> 
            <input type="hidden" value="" name="detailproduk"/> 
            <div class="form-group">
              <label class="control-label col-md-6">Nama Produk</label>
              <div class="col-md-12">
                <input name="namaproduk" placeholder="Nama Produk" class="form-control" type="text">
                <span class="text-danger"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-6">Harga Produk</label>
              <div class="col-md-12">
                <input name="hargaproduk" placeholder="Harga Produk" class="form-control" type="number">
                <span class="text-danger"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-6">Gambar Produk</label>
              <div class="row">
                <div class="col-md-3">
                  <input id="gambar1" name="gambar1" placeholder="Harga Produk" class="form-control" type="file" accept="image/jpg,image/png,image/jpeg" onchange="previewImage1();">
                  <span class="text-danger"></span>
                  <input type="text" id="image1" name="image1" class="form-control" hidden="true">

                  <img src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg" id="imgresult1" class="img-fluid rounded shadow-sm mx-auto d-block">
                </div>
                <div class="col-md-3">
                  <input id="gambar2" name="gambar2" placeholder="Harga Produk" class="form-control" type="file" accept="image/jpg,image/png,image/jpeg" onchange="previewImage2();">
                  <span class="text-danger"></span>
                  <input type="text" id="image2" name="image2" class="form-control" hidden="true">

                  <img src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg" id="imgresult2" class="img-fluid rounded shadow-sm mx-auto d-block">

                </div>
                <div class="col-md-3">
                  <input id="gambar3" name="gambar3" placeholder="Harga Produk" class="form-control" type="file" accept="image/jpg,image/png,image/jpeg" onchange="previewImage3();">
                  <span class="text-danger"></span>
                  <input type="text" id="image3" name="image3" class="form-control" hidden="true">

                  <img src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg" id="imgresult3" class="img-fluid rounded shadow-sm mx-auto d-block">

                </div>
                <div class="col-md-3">
                  <input id="gambar4" name="gambar4" placeholder="Harga Produk" class="form-control" type="file" accept="image/jpg,image/png,image/jpeg" onchange="previewImage4();">
                  <span class="text-danger"></span>
                  <input type="text" id="image4" name="image4" class="form-control" hidden="true">

                  <img src="<?= base_url(); ?>assets/dist/img/boxed-bg.jpg" id="imgresult4" class="img-fluid rounded shadow-sm mx-auto d-block">

                </div>
              </div>
            </div>
          </div>
          <!-- Form Input Kanan -->
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-6">Merk</label>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <select id="merkproduk" name="merkproduk" class="form-control">

                    </select>
                    <span class="text-danger"></span>
                  </div>
                  <div class="col-md-6">
                    <input name="newmerk" placeholder="New Merk Produk" class="form-control" type="text">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Deskripsi</label>
              <div class="col-md-12">
                <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi Produk" class="form-control" style="height: 120px;"></textarea>
                <span class="text-danger"></span>
              </div>
            </div>
            <label class="control-label col-md-12">Jumlah Stok per Size</label>
            <div class="row">
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="control-label">Size 39</label>
                    </div>
                    <div class="col-md-12">
                      <input name="size39" placeholder="Stok 39" class="form-control" type="number" value="0">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="control-label">Size 40</label>
                    </div>
                    <div class="col-md-12">
                      <input name="size40" placeholder="Stok 40" class="form-control" type="number" value="0">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="control-label">Size 41</label>
                    </div>
                    <div class="col-md-12">
                      <input name="size41" placeholder="Stok 41" class="form-control" type="number" value="0">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-sm-6">
                <!-- radio -->
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="control-label">Size 42</label>
                    </div>
                    <div class="col-md-12">
                      <input name="size42" placeholder="Stok 42" class="form-control" type="number" value="0">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="control-label">Size 43</label>
                    </div>
                    <div class="col-md-12">
                      <input name="size43" placeholder="Stok 43" class="form-control" type="number" value="0">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="control-label">Size 44</label>
                    </div>
                    <div class="col-md-12">
                      <input name="size44" placeholder="Stok 44" class="form-control" type="number" value="0">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


						<!--

            <div class="form-group">
              <label class="control-label">Jumlah Stok</label>
              <input id="jumlahstok" name="jumlahstok" placeholder="Jumlah Stok" class="form-control" type="number" readonly="true">
              <span class="help-block"></span>
            </div>
            <div class="form-group">
							<label class="control-label col-md-3">Gender</label>
							<div class="col-md-9">
								<select name="gender" class="form-control">
									<option value="">--Select Gender--</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Date of Birth</label>
							<div class="col-md-9">
								<input name="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
								<span class="help-block"></span>
							</div>
						</div>-->
          </div>
          <div class="modal-footer">
            <button type="submit" id="btnSave" onclick="save();" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

</body>
</html>