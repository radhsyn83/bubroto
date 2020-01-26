<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		$sess = $this->session->userdata();
		if (!isset($sess["id"])) {
			$this->load->view('auth');
		} else {
			redirect(base_url());
		}
	}

	public function do_login()
	{
		$dataSelect["username"] = $this->input->post("username");
		$dataSelect["passwd"] = md5($this->input->post("password"));

		$query = $this->db->select('a.id, a.nama, a.id_jabatan, b.nama as jabatan')
			->from('user a')
			->join('jabatan b', 'a.id_jabatan = b.id', "left")
			->where($dataSelect)
			->get();

		if ($query->num_rows() > 0) {
			$res = $query->row();
			$d_session["id"] = $res->id;
			$d_session["nama"] = $res->nama;
			$d_session["id_jabatan"] = $res->id_jabatan;
			$d_session["jabatan"] = $res->jabatan;

			$this->session->set_userdata($d_session);

			JSON($query->row(), "Login Berhasil!!");
		} else {
			JSON(null, "Username atua Password tidak sesuai.", 1);
		}
	}

	public function do_logout() {
		$this->session->sess_destroy();
		echo json_encode("logout");
	}
}
