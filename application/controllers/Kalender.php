<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalender extends CI_Controller {

	public function index()
	{
		$data["ea"] = "ea";
		$r = $this->load->view('kalender', $data, TRUE);
		echo $r;
	}
}
