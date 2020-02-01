<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function _output($content)
	{
		$sess = $this->session->userdata();
		if (!isset($sess["id"])) {
			redirect("auth");
		} else {
			$data['sess'] = &$sess;
			$data['content'] = &$content;
			switch ($sess["id_jabatan"]) {
				case 1:
					echo($this->load->view('pelayan/main', $data, true));
					break;
				case 2:
					echo($this->load->view('koki/main', $data, true));
					break;
				case 3:
					echo($this->load->view('kasir/main', $data, true));
					break;
				case 4:
					echo($this->load->view('pantry/main', $data, true));
					break;
				case 5:
					echo($this->load->view('cs/main', $data, true));
					break;
				case 6:
					echo($this->load->view('pemilik/main', $data, true));
					break;
				default:
					$this->session->sess_destroy();
					redirect("auth");
					break;
			}
		}
	}

}
