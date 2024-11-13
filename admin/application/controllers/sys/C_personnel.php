<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_personnel extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('sys/M_personnel', 'personnel');
	}

	public function index(){
		$data['all_data'] = $this->personnel->get_data();

		$structure = $this->personnel->get_structure();
		$data['select_structure'] = create_select_list($structure, 'code_str', 'sigle_str');

		$this->load->view('sys/V_personnel', $data);
	}

	public function save(){
		$personnelID = $this->input->post('id');
		if (empty($personnelID)) { 
			$this->add();
		} else { 
			$this->update($personnelID);
		}
	}

	private function add(){
		$code_str = $this->input->post('code_str');

		$u = $this->personnel->verif_matricule($code_str);
		if (!empty($u)) {
			$d = array("etat" => "error", "message" => "structure deja utilisateur");
			echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		
		} else {
			$this->personnel->matricule = $this->input->post('matricule');
			$this->personnel->prenom = $this->input->post('prenom');
			$this->personnel->nom = $this->input->post('nom');
			$this->personnel->email_pro = $this->input->post('email_pro');
			$this->personnel->code_str = $this->input->post('code_str');
			$this->personnel->etat = parse_etat_form($this->input->post('etat'));
			$this->personnel->code_annees = date('Y');
			$this->personnel->date_creation = date('Y-m-d H:i:s');
			echo json_encode($this->personnel->save(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		}
	}

	private function update($id){
		$this->personnel->id = $id;
		$this->personnel->matricule = $this->input->post('matricule');
		$this->personnel->prenom = $this->input->post('prenom');
		$this->personnel->nom = $this->input->post('nom');
		$this->personnel->email_pro = $this->input->post('email_pro');
		$this->personnel->code_str = $this->input->post('code_str');
		$this->personnel->etat = parse_etat_form($this->input->post('etat'));
		$this->personnel->date_modification = date('Y-m-d H:i:s');
		echo json_encode($this->personnel->custom_update(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	public function get_record(){
		$args = func_get_args();
		$this->personnel->id = $args[0];
		$this->personnel->get_record();
		echo json_encode($this->personnel, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	public function delete(){
		$args = func_get_args();
		$this->personnel->id = $args[0];
		echo json_encode($this->personnel->fake_delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}
}
