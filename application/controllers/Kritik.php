<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kritik extends CI_Controller {

	public function index()
	{
		$data["ea"] = "ea";
		$r = $this->load->view('kritik', $data, TRUE);
		echo $r;
	}
}
