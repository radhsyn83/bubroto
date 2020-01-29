<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koki extends CI_Controller
{

	public function index()
	{
	}

	public function pesanan()
	{
		$this->load->view('koki/pesanan');
	}

	public function menu()
	{
		$this->load->view('koki/menu');
	}

	public function bahan()
	{
		$this->load->view('koki/bahan');
	}

	public function get_pesanan()
	{
		$query = $this->db->select("dp.id, dp.jumlah, dp.nama_menu, ps.nomor_meja, dp.status")
			->from("detail_pesanan dp")
			->join("pesanan ps", "dp.id_pesanan = ps.id")
			->where("dp.status = 1")
			->get();

		$total = 0;
		foreach ($query->result() as $d) {
			$total = $total + $d->jumlah;
		}

		$res = new stdClass();
		$res->list = $query->result();
		$res->total = $total;

		JSON($res);
	}

	function set_selesai()
	{
		$id = $this->input->post("id");
		$this->db->trans_begin();

		//GET BAHAN_REQUEST
		$bahan = $this->db->get_where("detail_pesanan", array('id' => $id))->row();

		//GET MENU
		$menu = $this->db->get_where("menu_bahan", array('id_menu' => $bahan->id_menu))->result();

		//INSERT KE BAHAN STOK

		foreach ($menu as $m) {
			$dataInsert = array(
				'id_pantry' => 7,
				'id_bahan' => $m->id_bahan,
				'stok' => (($m->kebutuhan * $bahan->jumlah) * -1),
				'status' => 2
			);

			$this->db->insert("bahan_stok", $dataInsert);
		}

		//UPDATE STATUS ke SELESAI
		$this->db->set('status', 3);
		$this->db->where('id', $id);
		$this->db->update('detail_pesanan');

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

	function set_habis()
	{
		$id = $this->input->post("id");
		$this->db->set('status', 4);
		$this->db->where('id', $id);
		$this->db->update('detail_pesanan');
		JSON(null);
	}

	public function get_menu()
	{
		$query = $this->db->get("menu");
		JSON($query->result());
	}

	public function get_bahan()
	{
		$selectData["mb.id_menu"] = $this->input->post("id");
		$query = $this->db->select("mb.id, mb.kebutuhan, mb.id_bahan, bh.nama, bh.satuan")
			->from("menu_bahan mb")
			->join("bahan bh", "mb.id_bahan = bh.id")
			->where($selectData)
			->get();

		JSON($query->result());
	}

	public function get_list_bahan()
	{
		$dataSelect["active"] = 1;
		$query = $this->db->get_where("bahan", $dataSelect);
		JSON($query->result());
	}

	public function get_bahan_baku()
	{
		$dataSelect["active"] = 1;
		$query = $this->db->select("bs.id_bahan, sum(bs.stok) as sisa, bh.nama, bh.satuan, (SELECT COUNT(br.id) as tersedia FROM bahan_request br WHERE br.id_bahan = bs.id_bahan AND br.status = 0 ORDER BY br.id_bahan DESC LIMIT 1) as request")
			->from("bahan bh")
			->join("bahan_stok bs", "bh.id = bs.id_bahan")
			->where($dataSelect)
			->group_by("bs.id_bahan")
			->get();
		JSON($query->result());
	}

	public function addOrUpdateMenu()
	{
		$params = $this->input->post();

		if ($params["m_id"] != "") {
			//UPDATE
			$this->db->set('nama', $params["m_nama"]);
			$this->db->set('harga', $params["m_harga"]);
			$this->db->where('id', $params["m_id"]);
			$this->db->update('menu');
		} else {
			//ADD
			$dataInsert = array(
				'nama' => $params["m_nama"],
				'harga' => $params["m_harga"],
			);

			$this->db->insert('menu', $dataInsert);
		}

		echo json_encode("ea");
	}

	public function addOrUpdateBahan()
	{
		$params = $this->input->post();

		if ($params["f_id"] != "") {
			//UPDATE
			$this->db->set('id_bahan', $params["f_id_bahan"]);
			$this->db->set('kebutuhan', $params["f_kebutuhan"]);
			$this->db->where('id', $params["f_id"]);
			$this->db->update('menu_bahan');
		} else {
			//ADD
			$dataInsert = array(
				'id_menu' => $params["f_id_menu"],
				'id_bahan' => $params["f_id_bahan"],
				'kebutuhan' => $params["f_kebutuhan"]
			);

			$this->db->insert('menu_bahan', $dataInsert);
		}

		echo json_encode("ea");
	}

	public function addOrUpdateBahanBaku()
	{
		$params = $this->input->post();

		if ($params["f_id"] != "") {
			//UPDATE
			$this->db->set('nama', $params["f_nama"]);
			$this->db->set('satuan', $params["f_satuan"]);
			$this->db->where('id', $params["f_id"]);
			$this->db->update('bahan');
		} else {
			//ADD
			$dataInsert = array(
				'nama' => $params["f_nama"],
				'satuan' => $params["f_satuan"],
			);

			$this->db->insert('bahan', $dataInsert);
		}

		echo json_encode("ea");
	}

	function hapusMenu()
	{
		$id = $this->input->post("id");
		$this->db->delete('menu', array('id' => $id));
		echo json_encode("a");
	}

	function hapusBahan()
	{
		$id = $this->input->post("id");
		$this->db->delete('menu_bahan', array('id' => $id));
		echo json_encode("a");
	}

	function hapusBahanBaku()
	{
		$id = $this->input->post("id");
		$this->db->set('active', 0);
		$this->db->where('id', $id);
		$this->db->update('bahan');
		echo json_encode("a");
	}

	function request_bahan() {
		$params = $this->input->post();
		$dataInsert = array(
			'id_bahan' => $params["m_id"],
			'kebutuhan' => $params["m_jumlah"],
		);
		$this->db->insert('bahan_request', $dataInsert);
		echo json_encode("a");
	}

}
