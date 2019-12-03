<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function index()
	{
		$data["ea"] = "ea";
		$r = $this->load->view('berita', $data, TRUE);
		echo $r;
	}
}
