<?php

class C_annees extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('parametres/M_annees', 'annees');
	}

	public function index(){
		$data['all_data'] = $this->annees->get_data();

		$this->load->view('parametres/V_annees', $data);
	}

	public function save(){
		$libelle_annees = $this->input->post('libelle_annees');
		$id_annees = $this->input->post('id_annees');

		if (empty($id_annees)) {
			$this->add($libelle_annees);
		} else {
			$this->update($id_annees, $libelle_annees);
		}
	}

	private function add($libelle_annees){
		if ($this->annees->verif_annee($libelle_annees) !== null) {
			$d = array("status" => "error", "message" => "Cette annee existe deja.");
			echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
			die();
		}

		$this->annees->libelle_annees = $libelle_annees;
		$this->annees->etat_annees = parse_etat_form($this->input->post('etat_annees'));
		echo json_encode($this->annees->save(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	private function update($id_annees, $libelle_annees){
		$this->annees->id_annees = $id_annees;
		$this->annees->libelle_annees = $libelle_annees;
		$this->annees->etat_annees = parse_etat_form($this->input->post('etat_annees'));
		echo json_encode($this->annees->custom_update(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	public function get_record(){
		$args = func_get_args();
		$this->annees->id_annees = $args[0];
		$this->annees->get_record();
		echo json_encode($this->annees, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	public function delete(){
		$args = func_get_args();
		$this->annees->id_annees = $args[0];
		echo json_encode($this->annees->fake_delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}
}
