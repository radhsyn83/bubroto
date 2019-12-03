<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller {

	public function index()
	{
		$data["ea"] = "ea";
		$r = $this->load->view('mobile', $data, TRUE);
		echo $r;
	}
}
