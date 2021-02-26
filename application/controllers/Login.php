<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
	}
	public function index()
	{
		$x['msg'] = '';
		$this->load->view('login', $x);
	}
	function home()
	{
		$x['msg'] = 'Login Berhasil';
        $this->load->view('admin/beranda',$x);
	}
	function aksi_login(){
		$user=strip_tags(str_replace("'", "", $this->input->post('username')));
        $pass=strip_tags(str_replace("'", "", $this->input->post('password')));
        $cek = $this->Login_model->cek_login($user);
        if ($cek->num_rows() > 0) {
        	$row = $cek->row();
        	$pass2 = $row->pass_admin;
        	$nama = $row->nama_admin;
        	$id = $row->id_admin;
        	$verify = password_verify($pass, $pass2);
        	if ($verify) {
        		$this->session->set_userdata('namaAdmin',$nama);
        		$this->session->set_userdata('idAdmin',$id);
        		
        		$this->home();
        	} else {
        		$x['msg'] = 'Login Gagal | Password Salah';
        		$this->load->view('login',$x);
        	}
        } else {
        	$x['msg'] = 'Login Gagal | Username Tidak Ditemukan';
        	$this->load->view('login',$x);
        }
	}
	function register()
	{
		$this->load->view('register');
	}
	function daftar()
	{
		$user1=strip_tags(str_replace("'", "", $this->input->post('username')));
        $pass2=strip_tags(str_replace("'", "", $this->input->post('password')));
        $jabat=strip_tags(str_replace("'", "", $this->input->post('jabatan')));
        $this->Login_model->register($user1,$pass2,$jabat);
        redirect(base_url("admin"));
	}
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
