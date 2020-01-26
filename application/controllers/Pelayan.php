<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelayan extends CI_Controller
{

	public function index()
	{
	}

	public function pesanan()
	{
		$this->load->view('pelayan/pesanan');
	}

	public function get_menu()
	{
		$menu = $this->db->get('menu');

		$available_menu = array();

		foreach ($menu->result() as $m) {
			if ($this->check_available_menu($m) == 1) {
				$available_menu[] = $m;
			}
		}

		echo json_encode($available_menu);
	}

	function check_available_menu($m)
	{
		$available = 1;
		$id = $m->id;
		$query = $this->db->query("
				SELECT bs.id_bahan, b.nama, max(bs.stok) as tersedia, (SELECT mb2.kebutuhan FROM menu_bahan mb2 WHERE mb2.id_bahan = bs.id_bahan AND mb2.id_menu = $id) as kebutuhan FROM bahan_stok bs
JOIN bahan b ON b.id = bs.id_bahan
WHERE bs.id IN (select mb.id_bahan from menu_bahan mb where mb.id_menu = $id)
GROUP BY bs.id_bahan");

		foreach ($query->result() as $d) {
			$tersedia = 0;
			if ($d->tersedia >= $d->kebutuhan) {
				$tersedia = 1;
			}
			$available = $available * $tersedia;
		}

		return $available;
	}

	function add_menu()
	{
		$nomor_meja = $this->input->post("nomor_meja");
		$id = $this->input->post("id");
		$menu = $this->db->get_where("menu", array("id" => $id))->row();

		$meja = $this->db->get_where("pesanan", array("nomor_meja" => $nomor_meja, "status" => 0));
		if ($meja->num_rows() > 0) {
			//insert menu
			$dataInsert["id_pesanan"] = $meja->row()->id;
			$dataInsert["nama_menu"] = $menu->nama;
			$dataInsert["harga"] = $menu->harga;
			$dataInsert["jumlah"] = 1;
			$dataInsert["status"] = 1;
			$this->db->insert("detail_pesanan", $dataInsert);
			$this->updateMeja($nomor_meja);
		}
	}

	public function get_meja()
	{
		$nomor_meja = $this->input->post("nomor_meja");
		$this->updateMeja($nomor_meja);
	}

	function updateMeja($meja)
	{
		$selectData['ps.nomor_meja'] = $meja;
		$selectData['ps.status'] = 0;
		$query = $this->db->select('dp.*')
			->from('pesanan ps')
			->join('detail_pesanan dp', 'dp.id_pesanan = ps.id', 'left')
			->where($selectData)
			->get();

		$total_harga = 0;
		$total_item = 0;

		foreach ($query->result() as $d) {
			if ($d->status != 0 && $d->status != 4) {
				$total_harga = $total_harga + $d->harga;
				$total_item = $total_item + $d->jumlah;
			}
		}

		$grand["total_harga"] = number_format($total_harga);
		$grand["total_item"] = number_format($total_item);

		$res = new stdClass();
		$res->list = $query->result();
		$res->grand = $grand;

		JSON($res);
	}

	function set_selesai()
	{
		$nomor_meja = $this->input->post("nomor_meja");
		$id = $this->input->post("id");
		$this->change_status($id, 3, $nomor_meja);
	}

	function hapus()
	{
		$nomor_meja = $this->input->post("nomor_meja");
		$id = $this->input->post("id");
		$this->change_status($id, 0, $nomor_meja);
	}

	function change_status($id, $status, $meja)
	{
		$this->db->set('status', $status);
		$this->db->where('id', $id);
		$this->db->update('detail_pesanan');
		$this->updateMeja($meja);
	}

	function add()
	{
		$nomor_meja = $this->input->post("nomor_meja");
		$id = $this->input->post("id");
		$this->db->query("UPDATE detail_pesanan SET jumlah = jumlah+1 where id = $id");
		$this->updateMeja($nomor_meja);
	}

	function minus()
	{
		$nomor_meja = $this->input->post("nomor_meja");
		$id = $this->input->post("id");
		$this->db->query("UPDATE detail_pesanan SET jumlah = IF(jumlah = 1, 1, jumlah-1) where id = $id");
		$this->updateMeja($nomor_meja);
	}

}
