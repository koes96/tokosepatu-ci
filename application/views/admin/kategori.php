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
                <th>Nama Merk</th>
                <th style="width:125px;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
              <tr>
                <th>Nama Merk</th>
                <th style="width:125px;">Action</th>
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

var save_method; //for save method string
var table;

$(document).ready(function() {
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
        	"url": "<?= base_url('Admin/Kategori/ajax_list')?>",
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
    $('.text-danger').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Produk'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable 

  }

function edit_produk(idk)
{
	save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
    	url : "<?= base_url('Admin/Kategori/ajax_edit/')?>/" + idk,
    	type: "GET",
    	dataType: "JSON",
    	success: function(data)
    	{
    		$('[name="idk"]').val(data.id_merk);
    		$('[name="newmerk"]').val(data.nama_merk);
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
    	url = "<?= base_url('Admin/Kategori/ajax_add')?>";
    } else {
    	url = "<?= base_url('Admin/Kategori/ajax_update')?>";
    }

    var form = document.forms.namedItem('formdata');
    var form_data = new FormData(form);
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

  function delete_produk(idk)
  {
   if(confirm('Are you sure delete this data?'))
   {
        // ajax delete data to database
        $.ajax({
        	url : "<?= base_url('Admin/Kategori/ajax_delete')?>/"+idk,
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
    

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
   <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
      <h3 class="modal-title text-left">Produk Form</h3>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <form action="" id="form" name="formdata" class="form-horizontal" enctype="multipart/form-data" method="POST">
      <div class="modal-body form">
       <div class="form-body">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-6">Merk</label>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">                  	
            		<input type="hidden" value="" name="idk"/> 
                    <input name="newmerk" placeholder="New Merk Produk" class="form-control" type="text">
                    <span class="text-danger"></span>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
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