<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilik extends CI_Controller
{

	public function index()
	{
	}

	public function get_chart()
	{
		$dateStart = $this->input->post("dateStart");
		$dateEnd = $this->input->post("dateEnd");
		$query = $this->db->select('avg(ks.makanan) as mk, avg(ks.minuman) as mn, avg(ks.pelayanan)as pl, DATE_FORMAT(pb.tanggal, "%d") as day')
			->from('kuisioner ks')
			->join('pembayaran pb', 'ks.id_pembayaran = pb.id')
			->group_by('day')
			->order_by("day", "asc")
			->where('tanggal >=', $dateStart)
			->where('tanggal <=', $dateEnd)
			->get()
			->result();

		$dayInArray = array();
		$makanan = array();
		$minuman = array();
		$pelayanan = array();

		//date into array
		$i = 1;
		while ($i <= date('t')) {
			$mk = null;
			$mn = null;
			$pl = null;
			foreach ($query as $d) {
				$day = (int)$d->day;
				if ($i == $day) {
					$mk = round($d->mk, 2);
					$mn = round($d->mn, 2);
					$pl = round($d->pl, 2);
				}
			}
			if ($mk != null) {
				$makanan[] = $mk;
				$minuman[] = $mn;
				$pelayanan[] = $pl;
			} else {
				$makanan[] = 0;
				$minuman[] = 0;
				$pelayanan[] = 0;
			}
			$i++;
		}

		$data['makanan'] = $makanan;
		$data['minuman'] = $minuman;
		$data['pelayanan'] = $pelayanan;

		JSON($data);
	}

	public function get_pesanan()
	{
		$dateStart = $this->input->post("dateStart");
		$dateEnd = $this->input->post("dateEnd");

		$query = $this->db->select('sum(dp.jumlah) as sum, dp.status')
			->from('detail_pesanan dp')
			->join('pesanan ps','dp.id_pesanan = ps.id')
			->group_by('dp.status')
			->where('tanggal >=', $dateStart)
			->where('tanggal <=', $dateEnd)
			->get();

		$data["waiting"] = 0;
		$data["proses"] = 0;
		$data["selesai"] = 0;
		$data["pengunjung"] = $this->get_pengunjung($dateStart, $dateEnd);

		foreach ($query->result() as $d) {
			if ($d->status == 1) {
				$data["waiting"] = $d->sum;
			} else if ($d->status == 2) {
				$data["proses"] = $d->sum;
			} else if ($d->status == 3) {
				$data["selesai"] = $d->sum;
			}
		}

		JSON($data);

	}

	public function get_pengunjung($dateStart, $dateEnd)
	{
		$dataSelect['status'] = 1;
		$dataSelect['tanggal >='] = $dateStart;
		$dataSelect['tanggal <='] = $dateEnd;
		$query = $this->db->select('*')
			->from('pesanan')
			->where($dataSelect)
			->get();
		return $query->num_rows();
	}
}
