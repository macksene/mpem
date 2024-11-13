<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Accueil extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('text_helper');
		$this->load->helper('security');

		//initialisation de la session	
		$this->load->library('calendar');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('javascript');
	}

	public function home(){
		$data['contents'] = 'dashboard/home';

		$this->load->view('template/layout', $data);
	}
}
