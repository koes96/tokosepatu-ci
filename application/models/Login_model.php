<?php

/**
 * 
 */
class Login_model extends CI_Model
{
	var $user = 'users';
	function cek_login($user)
	{
		$query = $this->db->get_where('admin', array('nama_admin' => $user));
		return $query;
	}
	function register($user1,$pass2,$jabat)
	{
		$hsl=$this->db->query("INSERT INTO petugas(nama,password,jabatan) VALUES ('$user1',md5('$pass2'),'$jabat')");
		return $hsl;
	}

	function register_user($nama,$email,$hpass)
	{
		$cek = $this->db->get_where($this->user,array('email' => $email));
		if ($cek->num_rows() > 0) {
			$hsl = 'Email Sudah Terpakai';
			return $hsl;
		} else {
			$data = array(
        		'name' => $nama,
        		'email' => $email,
        		'password' => $hpass);
				$this->db->insert($this->user, $data);
				$hsl = 'Register Berhasil';
				return $hsl;
		}
	}

	function login_user($email,$pass)
	{
		$cek = $this->db->get_where($this->user,array('email' => $email));
		if ($cek->num_rows() > 0) {
			$r = $cek->row();
			$idu = $r->id;
			$nama = $r->name;
			$vpass = $r->password;
			$verify = password_verify($pass, $vpass);
			if ($verify) {
				$this->session->set_userdata('namaUser',$nama);
        		$this->session->set_userdata('idUser',$idu);
        		return true;
			} else {
				$hsl = 'Password Salah';
				return $hsl;
			}
		} else {

				$hsl = 'Data Tidak Ditemukan';
				return $hsl;
		}
	}
}