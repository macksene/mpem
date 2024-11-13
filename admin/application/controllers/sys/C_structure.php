<?php

class C_structure extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('sys/M_structure', 'structure');
	}

	public function index(){
		$data['all_data'] = $this->structure->get_data();
		$this->load->view('sys/V_structure', $data);
	}

	public function save(){
		$libelle = $this->input->post('libelle');
		$code_str = $this->input->post('code_str');

		if (empty($code_str)) {
			$this->add($libelle);
		} else {
			$this->update($code_str, $libelle);
		}
	}

	private function add($libelle){
		$libelleExist = $this->structure->verif_structure($libelle);
		if (isset($libelleExist)) {
			$d = array("status" => "error", "message" => "Cette structure existe deja.");
			echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
			die();
		}
		
		$this->structure->code_str = $code_str;
		$this->structure->libelle = $libelle;
		$this->structure->categorie = $this->input->post('categorie');
		$this->structure->sigle_str = $this->input->post('sigle_str');
		$this->structure->email_str = $this->input->post('email_str');
		$this->structure->tel_str = $this->input->post('tel_str');
		$this->structure->etat_str = parse_etat_form($this->input->post('etat_str'));
		echo json_encode($this->structure->save(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	private function update($id, $libelle){
		$this->structure->code_str = $id;
		$this->structure->libelle = $libelle;
		$this->structure->categorie = $this->input->post('categorie');
		$this->structure->sigle_str = $this->input->post('sigle_str');
		$this->structure->email_str = $this->input->post('email_str');
		$this->structure->tel_str = $this->input->post('tel_str');
		$this->structure->etat_str = parse_etat_form($this->input->post('etat_str'));
		echo json_encode($this->structure->custom_update(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	public function get_record(){
		$args = func_get_args();
		$this->structure->code_str = $args[0];
		$this->structure->get_record();
		echo json_encode($this->structure, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	public function delete(){
		$args = func_get_args();
		$this->structure->code_str = $args[0];
		echo json_encode($this->structure->fake_delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}
}
