<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cs extends CI_Controller
{

	public function index()
	{
	}

	public function get_kuisioner()
	{
		$query = $this->db->select("ks.id, ks.note, ks.nama as nama_pelanggan, cs.nama as nama_cs, kr.nama as nama_kasir, pl.nama as nama_pelayan, ks.date_add")
			->from("kuisioner ks")
			->join("pembayaran pb", "pb.id = ks.id_pembayaran")
			->join("user cs", "cs.id = ks.id_cs")
			->join("user kr", "kr.id = pb.id_kasir")
			->join("user pl", "pl.id = pb.id_pelayan")
			->get();

		JSON($query->result());
	}

	public function get_pembayaran() {
		$query = $this->db->get("pembayaran");
		JSON($query->result());
	}

	public function insert_kuisioner() {
		$param = $this->input->post();
		$dataInsert = array(
			'id_cs' => $this->session->userdata("id"),
			'id_pembayaran' => $param["f_pembayaran"],
			'nama' => $param["f_pelanggan"],
			'note' => $param["f_note"]
		);
		$this->db->insert("kuisioner", $dataInsert);
		echo json_encode("a");
	}

}
