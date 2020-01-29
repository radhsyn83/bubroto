<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pantry extends CI_Controller
{

	public function index()
	{
	}

	public function request()
	{
		$this->load->view('pantry/request');
	}

	public function kebutuhan()
	{
		$this->load->view('pantry/kebutuhan');
	}

	public function get_request()
	{
		$query = $this->db->select("br.id, br.kebutuhan, b.nama, b.satuan")
			->from("bahan_request br")
			->join("bahan b", " br.id_bahan = b.id")
			->where("br.status = 0")
			->get();

		$res = new stdClass();
		$res->list = $query->result();
		$res->total = $query->num_rows();

		JSON($res);
	}

	public function get_kebutuhan()
	{
		$query = $this->db->select("b.satuan, b.nama, mb.id_bahan, (sum(mb.kebutuhan) * sum(dp.jumlah)) as kebutuhan")
			->from("detail_pesanan dp")
			->join("menu_bahan mb", "dp.id_menu = mb.id_menu")
			->join("bahan b", " mb.id_bahan = b.id")
			->where("dp.status = 1")
			->group_by("id_bahan")
			->get();

		JSON($query->result());
	}

	function set_update()
	{
		$id = $this->input->post("id");
		$this->db->trans_begin();

		//GET BAHAN_REQUEST
		$bahan = $this->db->get_where("bahan_request", array('id' => $id))->row();

		//UPDATE STATUS BAHAN REQUEST
		$this->db->set('status', 1);
		$this->db->where('id', $id);
		$this->db->update('bahan_request');

		//INSERT BAHAN_STOK
		$dataInsert = array(
			'id_pantry' => $this->session->userdata("id"),
			'id_bahan' => $bahan->id_bahan,
			'stok' => $bahan->kebutuhan,
			'status' => 1
		);
		$this->db->insert("bahan_stok", $dataInsert);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			JSON(null);
		}
	}


}
