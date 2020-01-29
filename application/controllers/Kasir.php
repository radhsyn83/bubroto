<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller
{

	public function index()
	{
	}

	public function pembayaran()
	{
		$this->load->view('kasir/pembayaran');
	}

	public function laporan()
	{
		$this->load->view('kasir/laporan');
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

		$whereIn = array(1, 2, 3);

		$query = $this->db->select('dp.*')
			->from('pesanan ps')
			->join('detail_pesanan dp', 'dp.id_pesanan = ps.id', 'left')
			->where($selectData)
			->where_in("dp.status", $whereIn)
			->get();

		$total_harga = 0;
		$total_item = 0;

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $d) {
				$total_harga = $total_harga + ($d->harga * $d->jumlah);
				$total_item = $total_item + $d->jumlah;
			}

			$grand["total_harga"] = number_format($total_harga);
			$grand["total_item"] = number_format($total_item);

			$res = new stdClass();
			$res->list = $query->result();
			$res->grand = $grand;

			JSON($res);

		} else {
			$grand["total_harga"] = number_format($total_harga);
			$grand["total_item"] = number_format($total_item);

			$res = new stdClass();
			$res->list = null;
			$res->grand = $grand;

			JSON($res, "Daftar pesanan tidak tersedia.", 1);
		}
	}

	function bayar() {
		$params = $this->input->post();
		$selectPesanan['nomor_meja'] = $params["f_meja"];
		$selectPesanan['status'] = 0;

		$this->db->trans_begin();

		//GET PESANAN
		$pesanan = $this->db->get_where("pesanan", $selectPesanan)->row();
		//GET TOTAL
		$total = $this->db->select("id_pesanan, sum(harga*jumlah) as total_harga, sum(jumlah) as total_jumlah")
			->from("detail_pesanan")
			->where("id_pesanan", $pesanan->id)
			->where_in("status", array(1, 2, 3))
			->get()
			->row();
		//UPDATE PESANAN
		$this->db->set('status', 1);
		$this->db->where('id', $total->id_pesanan);
		$this->db->update('pesanan');
		//INSERT PEMBAYARAN
		$dataInsert["id_pesanan"] = $total->id_pesanan;
		$dataInsert["id_kasir"] = $this->session->userdata("id");
		$dataInsert["id_pelayan"] = $pesanan->id_pelayan;
		$dataInsert["total_pembayaran"] = $total->total_harga;
		$dataInsert["total_pesanan"] = $total->total_jumlah;
		$dataInsert["metode_pembayaran"] = $params["f_metode"];
		$this->db->insert("pembayaran", $dataInsert);
		$pembayaranId = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
			JSON($pembayaranId);
		}
	}
}
