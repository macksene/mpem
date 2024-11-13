<?php

class M_personnel extends MY_Model
{
	public $id;
	public $code_str;
	public $matricule;
	public $prenom;
	public $nom;
	public $etat;
	public $code_annees;
	public $date_creation;
	public $date_modification;
	public $date_suppression;



	public function custom_update(){
		$result = $this->db
			->where('id', $this->id)
			->update($this->get_db_table(), [
				'matricule' => $this->matricule,
				'prenom' => $this->prenom,
				'nom' => $this->nom,
				'etat' => $this->etat,
				'date_modification' => $this->date_modification,
			]);

		if ($result) {
			$status = 'success';
			$result = 'Modification effectué avec succées.';
		} else {
			$status = 'error';
			$result = 'Erreur lors de la modification.';
		}

		$d = array();
		$d['status'] = $status;
		$d['message'] = $result;

		return $d;
	}

	public function fake_delete(){
		$result = $this->db
			->where($this->get_db_table_pk(), $this->id)
			->update($this->get_db_table(), [$this->get_db_table_etat() => '0','date_suppression' => date('Y-m-d H:i:s')]);

		if ($result) {
			$status = 'success';
			$result = 'Archivage effectué avec succées.';
		} else {
			$status = 'error';
			$result = 'Erreur lors de la modification.';
		}

		$d = array();
		$d['status'] = $status;
		$d['message'] = $result;

		return $d;
	}

	public function get_data(){
		if ($_SESSION['code_str_session'] )
			return $this->db->select("pers.*, str.code_str, str.sigle_str")
				->from($this->get_db_table() . ' as pers')
				->join('structure as str', 'str.code_str = pers.code_str')
				->where('pers.etat !="0"')
				->order_by("etat", "asc")
				->order_by("nom, prenom", "asc")
				->get()
				->result();
		else {
			return $this->db->select("pers.*, str.code_str, str.sigle_str")
				->from($this->get_db_table() . ' as pers')
				->join('structure as str', 'str.code_str = pers.code_str')
				->where('str.code_str', $_SESSION['code_str_session'])
				->where('pers.etat !="0"')
				->order_by("etat", "asc")
				->order_by("nom, prenom", "asc")
				->get()
				->result();
		}
	}

	public function get_structure(){
		return $this->db->select("*")
			->from('structure')
			->get()
			->result();
	}
	
	public function verif_matricule($matricule){
		return $this->db->select('*')
			->from('personnel')
			->where('matricule', $matricule)
			->get()
			->row();
	}

	public function get_db_table(){
		return 'personnel';
	}

	public function get_db_table_pk(){
		return 'id';
	}

	public function get_db_table_etat(){
		return 'etat';
	}
}
