<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

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
		$this->load->model('Merk_model');
	}
	public function index()
	{
		$this->load->view('admin/kategori');
	}
	public function kategori()
	{
		$x['msg'] = 'Halo';
		$this->load->view('admin/kategori', $x);
	}
	public function ajax_list()
	{
		$list = $this->Merk_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->nama_merk;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_produk('."'".$person->id_merk."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_produk('."'".$person->id_merk."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Merk_model->count_all(),
						"recordsFiltered" => $this->Merk_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($idk)
	{
		$data = $this->Merk_model->get_by_id($idk);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();

		$newmerk=strip_tags(str_replace("'", "", $this->input->post('newmerk')));
		$data = array(
			'nama_merk' => $newmerk
		);
		$insert = $this->Merk_model->save($data);
		if ($insert) {
			echo json_encode(array("status" => TRUE));
		} else {
			echo json_encode(array("status" => FALSE));
		}

	}

	public function ajax_update()
	{
		$this->_validate();
		$idk=strip_tags(str_replace("'", "", $this->input->post('idk')));
		$newmerk=strip_tags(str_replace("'", "", $this->input->post('newmerk')));
		$data = array(
			'nama_merk' => $newmerk
		);
		$update = $this->Merk_model->update(array('id_merk' => $idk), $data);
		if ($update) {
			echo json_encode(array("status" => TRUE));
		} else {
			echo json_encode(array("status" => FALSE));
		}
		
	}

	public function ajax_delete($idk)
	{
		$this->Merk_model->delete_by_id($idk);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('newmerk') == '')
		{
			$data['inputerror'][] = 'newmerk';
			$data['error_string'][] = 'Nama Merk is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
