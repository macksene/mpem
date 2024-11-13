<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index(){
		$tab_data_ses = $this->session->all_userdata();
		if (!isset($tab_data_ses['matricule']) || empty($tab_data_ses['code_str_session']) || empty($tab_data_ses['prenom'])) {
			$data = array();
			$this->load->view('dashboard/sign-in', $data);
		} else {
			$this->load->view('template/layout');
		}
	}

	public function login(){
		//$data['contents'] = 'dashboard/container';
		//$this->load->view('template/layout', $data);
		$data = array();
		$this->load->view('dashboard/login', $data);
	}
}
