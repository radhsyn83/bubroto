<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visi extends CI_Controller {

	public function index()
	{
		$data["ea"] = "ea";
		$r = $this->load->view('visi', $data, TRUE);
		echo $r;
	}
}
