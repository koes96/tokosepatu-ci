<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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

	public $perPage = 3;
	function __construct()
	{
		parent::__construct();
		/*if ($this->session->userdata('idAdmin') == "") {
			redirect(base_url("admin"));
		}*/
		$this->load->model('Login_model');
		$this->load->model('Produk_model');
	}
	public function index()
	{
		//$this->load->view('user/beranda');
		$data['msg'] = '';
        //Total records Count
        $totalPosts = $this->Produk_model->getPostsCount();
        $data['total_pages']  = ceil($totalPosts/$this->perPage);

        if(!empty($this->input->get("page"))){
            $start = $this->perPage * $this->input->get('page');
            $data['posts'] = $this->Produk_model->getPosts($this->perPage,$start); //limit,start
            $this->load->view('user/ajax_scroll',$data);
        }
        else {
            $start =0;
            $data['posts'] = $this->Produk_model->getPosts($this->perPage,$start); //limit,start
            $this->load->view('user/beranda',$data);
        }

	}
	function cekSession()
	{
		if ($this->session->userdata('idUSer') == "") {
			redirect(base_url("Login"));
		}
	}
	function detailProduk($idproduk)
	{
		//$this->cekSession();

		//$idp=strip_tags(str_replace("'", "", $this->input->post('idProduk')));
		/*$idp = $this->uri->segment(3);
		$json = $this->Produk_model->get_by_id($idp);*/
		$x['idproduk'] = $idproduk;
		$this->load->view('user/detailProduk', $x);
	}

	function tampilProduk($idp)
	{
		$json = $this->Produk_model->get_by_id($idp);
		echo json_encode($json);
	}

	function loginUser()
	{
		$x['msg'] = '';
		$this->load->view('user/login', $x);
	}
	function login()
	{
        $email=strip_tags(str_replace("'", "", $this->input->post('email')));
        $pass=strip_tags(str_replace("'", "", $this->input->post('password')));
        $hsl = $this->Login_model->login_user($email,$pass);
        if ($hsl != 1) {
        	$x['msg'] = 'Email / Password salah';
        	$this->load->view('user/login', $x);
        } else {
        	redirect('Home');
        }
	}

	function registerUser()
	{
		$x['msg'] = 'Silahkan Input Data Diri';
		$this->load->view('user/register', $x);
	}
	function register()
	{
		$nama=strip_tags(str_replace("'", "", $this->input->post('nama')));
        $email=strip_tags(str_replace("'", "", $this->input->post('email')));
        $pass=strip_tags(str_replace("'", "", $this->input->post('password')));
        $vpass=strip_tags(str_replace("'", "", $this->input->post('veripassword')));
        if ($pass == $vpass) {
        	$hpass = password_hash($pass, PASSWORD_DEFAULT);
        	
        	$x['msg'] = $this->Login_model->register_user($nama,$email,$hpass);
        	$this->load->view('user/register', $x);
        } else {
        	$x['msg'] = 'Password Tidak Sama';
        	$this->load->view('user/register', $x);
        }
	}

	function logout()
	{
		$this->session->unset_userdata('namaUser');
		$this->session->unset_userdata('idUser');
		//redirect('Home');
		$data['msg'] = 'Berhasil Keluar';
		$this->load->view('user/beranda', $data);
	}
}
