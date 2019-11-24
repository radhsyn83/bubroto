<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour extends CI_Controller {

	public function index()
	{
		$data["ea"] = "ea";
		$r = $this->load->view('tour', $data, TRUE);
		echo $r;
	}

	public function get_data() {
		$query = $this->db->get_where('tb_tour', array('active' => 1));
		echo json_encode($query->result());
	}

	public function get_data_sub($id_tour) {
		$query = $this->db->get_where('tb_tour_sub', array('active' => 1, 'id_tour' => $id_tour));
		echo json_encode($query->result());
	}
}
