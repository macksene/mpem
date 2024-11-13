<?php

class M_articles extends MY_Model{
	public $id_articles;
	public $titre;
	public $description;
	public $contenu;
	public $photo;
	public $publie;
	public $alaune;
	public $etat;
	public $code_annees;
	public $matricule;
	public $date_creation;
	public $date_modification;
	public $date_suppression;
	
	
	public function add_articles(){
		$result = $this->db
			->insert($this->get_db_table(), [
				'titre' => $this->titre,
				'description' => $this->description,
				'contenu' => $this->contenu,
				'photo' => $this->photo,
				'publie' => $this->publie,
				'alaune' => $this->alaune,
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
	
	public function update_articles(){
		$result = $this->db
			->where('id_articles', $this->id_articles)
			->update($this->get_db_table(), [
				'titre' => $this->titre,
				'description' => $this->description,
				'contenu' => $this->contenu,
				'publie' => $this->publie,
				'alaune' => $this->alaune,
				'photo' => $this->photo,
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
			->where($this->get_db_table_pk(), $this->id_articles)
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
			return $this->db->select("art.*")
				->from($this->get_db_table() . ' as art')
				->where('art.etat !="0"')
				->order_by("etat", "desc")
				->order_by("date_creation", "desc")
				->get()
				->result();
		else {
			return $this->db->select("art.*")
				->from($this->get_db_table() . ' as art')
				->where('str.code_str', $_SESSION['code_str_session'])
				->where('art.etat !="0"')
				->order_by("etat", "desc")
				->order_by("date_creation", "desc")
				->get()
				->result();
		}
	}
	
	public function get_db_table(){
		return 'articles';
	}

	public function get_db_table_pk(){
		return 'id_articles';
	}

	public function get_db_table_etat(){
		return 'etat';
	}
}