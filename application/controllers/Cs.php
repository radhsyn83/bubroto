<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cs extends CI_Controller
{

	public function index()
	{
	}

	public function get_kuisioner()
	{
		$query = $this->db->select("ks.id_pembayaran, pb.tanggal as date_add, ks.id, ks.makanan, ks.minuman, ks.pelayanan, ks.nama as nama_pelanggan")
			->from("kuisioner ks")
			->join("pembayaran pb", "pb.id = ks.id_pembayaran")
			->join("user cs", "cs.id = ks.id_cs")
			->join("user kr", "kr.id = pb.id_kasir")
			->join("user pl", "pl.id = pb.id_pelayan")
			->get();

		JSON($query->result());
	}

	public function get_pembayaran() {
		$dataSelect["id"] = $this->input->post("id");
		$dataSelect["is_kuisioner"] = 0;
		$query = $this->db->get_where("pembayaran", $dataSelect);

		if ($query->num_rows() > 0) {
			JSON($query->row());
		} else {
			JSON(null, "Pembayaran tidak ada / sudah di kuisioner", 1);
		}
	}

	public function insert_kuisioner() {
		$param = $this->input->post();
		$this->db->trans_begin();

		$dataInsert = array(
			'id_cs' => $this->session->userdata("id"),
			'id_pembayaran' => $param["f_pembayaran"],
			'nama' => $param["f_pelanggan"],
			'makanan' => $param["makanan"],
			'minuman' => $param["minuman"],
			'pelayanan' => $param["pelayanan"]
		);
		$this->db->insert("kuisioner", $dataInsert);

		//UPDATE
		$this->db->set('is_kuisioner', 1);
		$this->db->where('id', $param["f_pembayaran"]);
		$this->db->update('pembayaran');

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			echo json_encode("a");
		}
	}

}
