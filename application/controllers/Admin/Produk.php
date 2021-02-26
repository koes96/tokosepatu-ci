<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('idAdmin') == "") {
			redirect(base_url("admin"));
		}
		$this->load->model('Produk_model');
		$this->load->model('Detailproduk_model');
		$this->load->model('Merk_model');
	}
	public function index()
	{
		$x['msg'] = 'Halo !';
		$this->load->view('admin/beranda', $x);
	}
	function produk()
	{
		$x['msg'] = '';
		$x['merk'] = $this->Merk_model->getmerk();
		$this->load->view('admin/produk', $x);
	}
	function ambilmerk()
	{
		$data = $this->Merk_model->getmerk();
		echo json_encode($data);
	}
	public function ajax_list()
	{
		$list = $this->Produk_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->nama_produk;
			$row[] = $person->nama_merk;
			$row[] = $person->harga_produk;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_produk('."'".$person->id_produk."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_produk('."'".$person->id_produk."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                  
                  $data[] = $row;
          }

          $output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->Produk_model->count_all(),
                  "recordsFiltered" => $this->Produk_model->count_filtered(),
                  "data" => $data,
          );
		//output to json format
          echo json_encode($output);
  }

  public function ajax_edit($idp)
  {
      $data = $this->Produk_model->get_by_id($idp);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
      echo json_encode($data);
}

public function ajax_add()
{
      $this->_validate();
		//$nmfile = "shoes_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
		$config['upload_path'] = './assets/image-produk/'; //path folder
		$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE;
		//$config['file_name'] = $nmfile; //nama yang terupload nantinya
		$this->load->library('upload', $config);

		$nama=strip_tags(str_replace("'", "", $this->input->post('namaproduk')));
                $merk=strip_tags(str_replace("'", "", $this->input->post('merkproduk')));
                $newmerk=strip_tags(str_replace("'", "", $this->input->post('newmerk')));
                $harga=strip_tags(str_replace("'", "", $this->input->post('hargaproduk')));
        //Detail Produk
                $s39=strip_tags(str_replace("'", "", $this->input->post('size39')));
                $s40=strip_tags(str_replace("'", "", $this->input->post('size40')));
                $s41=strip_tags(str_replace("'", "", $this->input->post('size41')));
                $s42=strip_tags(str_replace("'", "", $this->input->post('size42')));
                $s43=strip_tags(str_replace("'", "", $this->input->post('size43')));
                $s44=strip_tags(str_replace("'", "", $this->input->post('size44')));
                $deskripsi=strip_tags(str_replace("'", "", $this->input->post('deskripsi')));
                if ($merk == '') {
                       $datamerk = array(
                            'nama_merk' => $newmerk,
                    );
                       $insert = $this->db->insert('merk',$datamerk);
                       $last_id = $this->db->insert_id();
                       if ($last_id != '') {
                              if (!$this->upload->do_upload('gambar1')) {
                                     echo json_encode(array("status" => FALSE,
                                            'upload_data' => $this->upload->display_errors()));
                                     
                             } else {
                                     $data = array(
                                            'nama_produk' => $nama,
                                            'merk_produk' => $last_id,
                                            'harga_produk' => $harga,
                                    );
                                     $insert = $this->Produk_model->save($data);
                                     $last_id;

                                     $jumlahstok = $s39+$s40+$s41+$s42+$s43+$s44;

                                     $data = array('upload_data' => $this->upload->data());
                                     $gbr1 = $this->upload->data('file_name');
                                     
                                     $upload2 = $this->upload->do_upload('gambar2');
                                     $data2 = array('upload_data' => $this->upload->data());
                                     $gbr2 = $this->upload->data('file_name');

                                     $upload3 = $this->upload->do_upload('gambar3');
                                     $data3 = array('upload_data' => $this->upload->data());
                                     $gbr3 = $this->upload->data('file_name');

                                     $upload4 = $this->upload->do_upload('gambar4');
                                     $data4 = array('upload_data' => $this->upload->data());
                                     $gbr4 = $this->upload->data('file_name');


                                     $datadetail = array(
                                            'produk_detailproduk' => $insert,
                                            'stok_detailproduk' => $jumlahstok,
                                            'size39' => $s39,
                                            'size40' => $s40,
                                            'size41' => $s41,
                                            'size42' => $s42,
                                            'size43' => $s43,
                                            'size44' => $s44,
                                            'gambar1' => $gbr1,
                                            'gambar2' => $gbr2,
                                            'gambar3' => $gbr3,
                                            'gambar4' => $gbr4,
                                            'deskripsi_detailproduk' => $deskripsi
                                    );
                                     $insert = $this->Detailproduk_model->save($datadetail);
                                     echo json_encode(array("status" => TRUE));
                             }
        		//echo json_encode(array("status" => TRUE));
                     } else {
                      echo json_encode(array("status" => FALSE));
              }
      } elseif ($merk != '') {
       if (!$this->upload->do_upload('gambar1')) {
             echo json_encode(array("status" => FALSE,
                    'upload_data' => $this->upload->display_errors()));
             
     } else {
             $data = array(
                    'nama_produk' => $nama,
                    'merk_produk' => $merk,
                    'harga_produk' => $harga,
            );
             $insert = $this->Produk_model->save($data);

             $jumlahstok = $s39+$s40+$s41+$s42+$s43+$s44;

             $data = array('upload_data' => $this->upload->data());
             $gbr1 = $this->upload->data('file_name');

             $upload2 = $this->upload->do_upload('gambar2');
             $data2 = array('upload_data' => $this->upload->data());
             $gbr2 = $this->upload->data('file_name');

             $upload3 = $this->upload->do_upload('gambar3');
             $data3 = array('upload_data' => $this->upload->data());
             $gbr3 = $this->upload->data('file_name');

             $upload4 = $this->upload->do_upload('gambar4');
             $data4 = array('upload_data' => $this->upload->data());
             $gbr4 = $this->upload->data('file_name');


             $datadetail = array(
                    'produk_detailproduk' => $insert,
                    'stok_detailproduk' => $jumlahstok,
                    'size39' => $s39,
                    'size40' => $s40,
                    'size41' => $s41,
                    'size42' => $s42,
                    'size43' => $s43,
                    'size44' => $s44,
                    'gambar1' => $gbr1,
                    'gambar2' => $gbr2,
                    'gambar3' => $gbr3,
                    'gambar4' => $gbr4,
                    'deskripsi_detailproduk' => $deskripsi
            );
             $insert = $this->Detailproduk_model->save($datadetail);
             echo json_encode(array("status" => TRUE));
     }
} else {
       echo json_encode(array("status" => FALSE));
}

}

public function ajax_update()
{
      $this->_validate();
		$config['upload_path'] = './assets/image-produk/'; //path folder
		$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE;
		//$config['file_name'] = $nmfile; //nama yang terupload nantinya
		$this->load->library('upload', $config);
		$idp=strip_tags(str_replace("'", "", $this->input->post('idp')));
		$idd=strip_tags(str_replace("'", "", $this->input->post('detailproduk')));
		$nama=strip_tags(str_replace("'", "", $this->input->post('namaproduk')));
                $merk=strip_tags(str_replace("'", "", $this->input->post('merkproduk')));
                $newmerk=strip_tags(str_replace("'", "", $this->input->post('newmerk')));
                $harga=strip_tags(str_replace("'", "", $this->input->post('hargaproduk')));
        //Detail Produk
                $s39=strip_tags(str_replace("'", "", $this->input->post('size39')));
                $s40=strip_tags(str_replace("'", "", $this->input->post('size40')));
                $s41=strip_tags(str_replace("'", "", $this->input->post('size41')));
                $s42=strip_tags(str_replace("'", "", $this->input->post('size42')));
                $s43=strip_tags(str_replace("'", "", $this->input->post('size43')));
                $s44=strip_tags(str_replace("'", "", $this->input->post('size44')));
                $desk=strip_tags(str_replace("'", "", $this->input->post('deskripsi')));
                if ($merk != 0 && $newmerk != '') {
                       $datamerk = array(
                            'nama_merk' => $newmerk,
                    );
                       $insert = $this->db->insert('merk',$datamerk);
                       $last_id = $this->db->insert_id();
                       if ($last_id != '') {
                              $data = array(
                                     'nama_produk' => $nama,
                                     'merk_produk' => $last_id,
                                     'harga_produk' => $harga,
                             );
                              $this->Produk_model->update(array('id_produk' => $idp), $data);
                              
                              $jumlahstok = $s39+$s40+$s41+$s42+$s43+$s44;

                              if ($this->upload->do_upload('gambar1')) {
                                      $data = array('upload_data' => $this->upload->data());
                                      $gbr1 = $this->upload->data('file_name');

                                      $gambarlama = strip_tags(str_replace("'", "", $this->input->post('image1')));

                                      $d = array(
                                             'id_detailproduk' => $idp,
                                             'gambar1' => $gbr1
                                     );
                                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $d);

        		//unlink('assets/image-produk/'.$gambarlama);
                              } else {
                                      $gbr1 = strip_tags(str_replace("'", "", $this->input->post('image1')));
                                      $d = array(
                                             'id_detailproduk' => $idp,
                                             'gambar1' => $gbr1
                                     );
                                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $d);
                              }
                              if ($this->upload->do_upload('gambar2')) {
                                      $data2 = array('upload_data' => $this->upload->data());
                                      $gbr2 = $this->upload->data('file_name');

                                      $gambarlama2 = strip_tags(str_replace("'", "", $this->input->post('image2')));

                                      $c = array(
                                             'id_detailproduk' => $idp,
                                             'gambar2' => $gbr2
                                     );
                                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $c);

        		//unlink('assets/image-produk/'.$gambarlama2);
                              } else {
                                      $gbr2 = strip_tags(str_replace("'", "", $this->input->post('image2')));
                                      $c = array(
                                             'id_detailproduk' => $idp,
                                             'gambar2' => $gbr2
                                     );
                                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $d);
                              }
                              if ($this->upload->do_upload('gambar3')) {
                                      $data3 = array('upload_data' => $this->upload->data());
                                      $gbr3 = $this->upload->data('file_name');

                                      $gambarlama3 = strip_tags(str_replace("'", "", $this->input->post('image3')));

                                      $b = array(
                                             'id_detailproduk' => $idp,
                                             'gambar3' => $gbr3
                                     );
                                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $b);

        		//unlink('assets/image-produk/'.$gambarlama3);
                              } else {
                                      $gbr3 = strip_tags(str_replace("'", "", $this->input->post('image3')));
                                      $b = array(
                                             'id_detailproduk' => $idp,
                                             'gambar3' => $gbr3
                                     );
                                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $b);
                              }
                              if ($this->upload->do_upload('gambar4')) {
                                      $data4 = array('upload_data' => $this->upload->data());
                                      $gbr4 = $this->upload->data('file_name');

                                      $gambarlama4 = strip_tags(str_replace("'", "", $this->input->post('image4')));
                                      

                                      $a = array(
                                             'id_detailproduk' => $idp,
                                             'gambar4' => $gbr4
                                     );
                                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $a);
        		//unlink('assets/image-produk/'.$gambarlama4);
                              } else {
                                      $gbr4 = strip_tags(str_replace("'", "", $this->input->post('image4')));
                                      $a = array(
                                             'id_detailproduk' => $idp,
                                             'gambar4' => $gbr4
                                     );
                                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $a);
                              }
                              $datadetail = array(
                                    'produk_detailproduk' => $idd,
                                    'stok_detailproduk' => $jumlahstok,
                                    'size39' => $s39,
                                    'size40' => $s40,
                                    'size41' => $s41,
                                    'size42' => $s42,
                                    'size43' => $s43,
                                    'size44' => $s44,
                                    'deskripsi_detailproduk' => $desk
                            );
                              $insert = $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $datadetail);

                              echo json_encode(array("status" => TRUE));
                      } else {
                              echo json_encode(array("status" => FALSE));
                      }
              } elseif ($merk != '' && $newmerk == '') {

               $data = array(
                      'nama_produk' => $nama,
                      'merk_produk' => $merk,
                      'harga_produk' => $harga,
              );
               $this->Produk_model->update(array('id_produk' => $idp), $data);

               $jumlahstok = $s39+$s40+$s41+$s42+$s43+$s44;

               if ($this->upload->do_upload('gambar1')) {
                      $data = array('upload_data' => $this->upload->data());
                      $gbr1 = $this->upload->data('file_name');

                      $gambarlama = strip_tags(str_replace("'", "", $this->input->post('image1')));

                      $d = array(
                             'id_detailproduk' => $idp,
                             'gambar1' => $gbr1
                     );
                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $d);

                      unlink('assets/image-produk/'.$gambarlama);
              } else {
                      $gbr1 = strip_tags(str_replace("'", "", $this->input->post('image1')));
                      $d = array(
                             'id_detailproduk' => $idp,
                             'gambar1' => $gbr1
                     );
                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $d);
              }
              if ($this->upload->do_upload('gambar2')) {
                      $data2 = array('upload_data' => $this->upload->data());
                      $gbr2 = $this->upload->data('file_name');

                      $gambarlama2 = strip_tags(str_replace("'", "", $this->input->post('image2')));

                      $c = array(
                             'id_detailproduk' => $idp,
                             'gambar2' => $gbr2
                     );
                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $c);

                      unlink('assets/image-produk/'.$gambarlama2);
              } else {
                      $gbr2 = strip_tags(str_replace("'", "", $this->input->post('image2')));
                      $c = array(
                             'id_detailproduk' => $idp,
                             'gambar2' => $gbr2
                     );
                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $d);
              }
              if ($this->upload->do_upload('gambar3')) {
                      $data3 = array('upload_data' => $this->upload->data());
                      $gbr3 = $this->upload->data('file_name');

                      $gambarlama3 = strip_tags(str_replace("'", "", $this->input->post('image3')));

                      $b = array(
                             'id_detailproduk' => $idp,
                             'gambar3' => $gbr3
                     );
                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $b);

                      unlink('assets/image-produk/'.$gambarlama3);
              } else {
                      $gbr3 = strip_tags(str_replace("'", "", $this->input->post('image3')));
                      $b = array(
                             'id_detailproduk' => $idp,
                             'gambar3' => $gbr3
                     );
                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $b);
              }
              if ($this->upload->do_upload('gambar4')) {
                      $data4 = array('upload_data' => $this->upload->data());
                      $gbr4 = $this->upload->data('file_name');

                      $gambarlama4 = strip_tags(str_replace("'", "", $this->input->post('image4')));
                      

                      $a = array(
                             'id_detailproduk' => $idp,
                             'gambar4' => $gbr4
                     );
                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $a);
                      unlink('assets/image-produk/'.$gambarlama4);
              } else {
                      $gbr4 = strip_tags(str_replace("'", "", $this->input->post('image4')));
                      $a = array(
                             'id_detailproduk' => $idp,
                             'gambar4' => $gbr4
                     );
                      $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $a);
              }
              $datadetail = array(
                    'produk_detailproduk' => $idd,
                    'stok_detailproduk' => $jumlahstok,
                    'size39' => $s39,
                    'size40' => $s40,
                    'size41' => $s41,
                    'size42' => $s42,
                    'size43' => $s43,
                    'size44' => $s44,
                    'deskripsi_detailproduk' => $desk
            );
              $insert = $this->Detailproduk_model->update(array('id_detailproduk' => $idp), $datadetail);

              echo json_encode(array("status" => TRUE));
      } else {
       echo json_encode(array("status" => FALSE));
}
}

public function ajax_delete($id)
{
      $idp = $id;
      $row = $this->Produk_model->get_by_id($idp);
      $iddetail = $row->produk_detailproduk;
      $g1 = $row->gambar1;
      $g2 = $row->gambar2;
      $g3 = $row->gambar3;
      $g4 = $row->gambar4;

      unlink('assets/image-produk/'.$g1);
      unlink('assets/image-produk/'.$g2);
      unlink('assets/image-produk/'.$g3);
      unlink('assets/image-produk/'.$g4);

      $this->Detailproduk_model->delete_by_id($iddetail);
      $this->Produk_model->delete_by_id($id);
      echo json_encode(array("status" => TRUE));
}

private function _validategambar()
{
      $data = array();
      $data['error_string'] = array();
      $data['inputerror'] = array();
      $data['status'] = TRUE;

      if($this->input->post('gambar1') == '')
      {
             $data['inputerror'][] = 'gambar1';
             $data['error_string'][] = 'Image is required';
             $data['status'] = FALSE;
     }
     if($this->input->post('gambar2') == '')
     {
             $data['inputerror'][] = 'gambar2';
             $data['error_string'][] = 'Image is required';
             $data['status'] = FALSE;
     }
     if($this->input->post('gambar3') == '')
     {
             $data['inputerror'][] = 'gambar3';
             $data['error_string'][] = 'Image is required';
             $data['status'] = FALSE;
     }
     if($this->input->post('gambar4') == '')
     {
             $data['inputerror'][] = 'gambar4';
             $data['error_string'][] = 'Image is required';
             $data['status'] = FALSE;
     }

     if($data['status'] === FALSE)
     {
             echo json_encode($data);
             exit();
     }
}
private function _validate()
{
      $data = array();
      $data['error_string'] = array();
      $data['inputerror'] = array();
      $data['status'] = TRUE;

      if($this->input->post('namaproduk') == '')
      {
             $data['inputerror'][] = 'namaproduk';
             $data['error_string'][] = 'Nama Produk is required';
             $data['status'] = FALSE;
     }

     if($this->input->post('merkproduk') == '' && $this->input->post('newmerk') == '')
     {
             $data['inputerror'][] = 'merkproduk';
             $data['error_string'][] = 'Merk Produk is required';
             $data['status'] = FALSE;
     }

     if($this->input->post('hargaproduk') == '')
     {
             $data['inputerror'][] = 'hargaproduk';
             $data['error_string'][] = 'Harga Produk is required';
             $data['status'] = FALSE;
     }

     if($this->input->post('deskripsi') == '')
     {
             $data['inputerror'][] = 'deskripsi';
             $data['error_string'][] = 'Deskripsi is required';
             $data['status'] = FALSE;
     }

     if($this->input->post('size39') == '')
     {
             $data['inputerror'][] = 'size39';
             $data['error_string'][] = 'Size is required';
             $data['status'] = FALSE;
     }
     if($this->input->post('size40') == '')
     {
             $data['inputerror'][] = 'size40';
             $data['error_string'][] = 'Size is required';
             $data['status'] = FALSE;
     }
     if($this->input->post('size41') == '')
     {
             $data['inputerror'][] = 'size41';
             $data['error_string'][] = 'Size is required';
             $data['status'] = FALSE;
     }
     if($this->input->post('size42') == '')
     {
             $data['inputerror'][] = 'size42';
             $data['error_string'][] = 'Size is required';
             $data['status'] = FALSE;
     }
     if($this->input->post('size43') == '')
     {
             $data['inputerror'][] = 'size43';
             $data['error_string'][] = 'Size is required';
             $data['status'] = FALSE;
     }
     if($this->input->post('size44') == '')
     {
             $data['inputerror'][] = 'size44';
             $data['error_string'][] = 'Size is required';
             $data['status'] = FALSE;
     }

     if($data['status'] === FALSE)
     {
             echo json_encode($data);
             exit();
     }
}
}
