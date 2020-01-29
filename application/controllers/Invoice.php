<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller
{

	public function index()
	{
		$this->load->view("invoice");
	}

	public function pembayaran($id) {
		$query = $this->db->select("mn.nama, mn.harga, dp.jumlah")
			->from("pembayaran pb")
			->join("detail_pesanan dp", "pb.id_pesanan = dp.id_pesanan")
			->join("menu mn", "dp.id_menu = mn.id")
			->where("pb.id = $id")
			->where_in("dp.status", array(1, 2, 3))
			->get();

		if ($query->num_rows() > 0) {
			$data["row"] = $query->result();
			$this->load->view("invoice", $data);
		} else {
			show_404();
		}
	}

}
