<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_sys_user extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('sys/M_sys_user', 'user');
		$this->load->model('sys/M_sys_profil', 'profil');
		//$this->load->model('M_personnel', 'pers');
		//$this->load->model('M_table_param');
	}

	public function index(){
		$user_data = $this->user->get_data();
		$data['all_data'] = $user_data;

		$profil = $this->profil->get_data();
		$data['select_profile'] = create_select_list($profil, 'id_type_profil', 'libelle_type_profil');

		$this->load->view('sys/V_sys_user', $data);
	}

	public function save(){
		$userID = $this->input->post('id');
		if (empty($userID)) { // -> Ajout Utilisateur ici
			$this->add();
		} else { // -> Modification Utilisateur ici
			$this->update($userID);
		}
	}

	private function update($id){
		$this->user->id = $id;
		$this->user->id_profil = $this->input->post('id_profil');
		$this->user->statut = parse_etat_form($this->input->post('statut'));

		echo json_encode($this->user->custom_update(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	private function add(){
		$matricule = trim($this->input->post('matricule'));
		if (!empty($this->user->verif_matriculeusr($matricule))) {
			$d = array("status" => "error", "message" => "matricule deja utilisateur");
			echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
			// NOTE: why the `die()` here???
			die();
		}

		$u = $this->user->verif_matriculepers($matricule);
		if (empty($u)) {
			$d = array("status" => "error", "message" => "matricule introuvable");
			echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
			// die();
		} else {
			$this->user->matricule = $matricule;
			$this->user->id_profil = $this->input->post('id_profil');
			$this->user->code_str =  $u->code_str;
			$this->user->statut    = parse_etat_form($this->input->post('statut'));
			echo json_encode($this->user->save(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		}
	}

	public function get_record(){
		$args = func_get_args();
		$this->user->matricule = $args[0];
		$this->user->id = $this->user->get_id_by_matricule($this->user->matricule);
		$this->user->get_record();
		echo json_encode($this->user, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

	public function delete(){
		$args = func_get_args();
		$this->user->id = $args[0];
		echo json_encode($this->user->fake_delete(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}
}
