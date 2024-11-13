<?php

class M_services extends MY_Model{
	public $id_services;
	public $departement;
	public $categorie;
	public $titre;
	public $description;
	public $fichier;
	public $photo;
	public $publie;
	public $etat;
	public $code_annees;
	public $matricule;
	public $date_creation;
	public $date_modification;
	public $date_suppression;
	
	
	public function add_services(){
		$result = $this->db
			->insert($this->get_db_table(), [
				'departement' => $this->departement,
				'categorie' => $this->categorie,
				'titre' => $this->titre,
				'description' => $this->description,
				'fichier' => $this->fichier,
				'photo' => $this->photo,
				'publie' => $this->publie,
				'etat' => $this->etat,
				'code_annees' => $this->code_annees,
				'matricule' => $this->matricule,
				'date_creation' => $this->date_creation,
			]);
		if ($result) {
			$status = 'success';
			$result = 'Insertion effectué avec succées.';
		} else {
			$status = 'error';
			$result = "Erreur lors de l'insertion.";
		}
		$d = array();
		$d['status'] = $status;
		$d['message'] = $result;
		return $d;
	}
	
	public function update_services(){
		$result = $this->db
			->where('id_services', $this->id_services)
			->update($this->get_db_table(), [
				'departement' => $this->departement,
				'categorie' => $this->categorie,
				'titre' => $this->titre,
				'description' => $this->description,
				'fichier' => $this->fichier,
				'photo' => $this->photo,
				'publie' => $this->publie,
				'etat' => $this->etat,
				'code_annees' => $this->code_annees,
				'matricule' => $this->matricule,
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
			->where($this->get_db_table_pk(), $this->id_services)
			->update($this->get_db_table(),[$this->get_db_table_etat() => '0','date_suppression' => date('Y-m-d H:i:s')]);
		if ($result) {
			$status = 'success';
			$result = 'Suppression effectué avec succées.';
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
			return $this->db->select("pub.*")
				->from($this->get_db_table() . ' as pub')
				->where('pub.etat !="0"')
				->order_by("etat", "desc")
				->order_by("date_creation", "desc")
				->get()
				->result();
		else {
			return $this->db->select("pub.*")
				->from($this->get_db_table() . ' as pub')
				->where('str.code_str', $_SESSION['code_str_session'])
				->where('pub.etat !="0"')
				->order_by("etat", "desc")
				->order_by("date_creation", "desc")
				->get()
				->result();
		}
	}
	
	public function get_db_table(){
		return 'services';
	}

	public function get_db_table_pk(){
		return 'id_services';
	}

	public function get_db_table_etat(){
		return 'etat';
	}
}