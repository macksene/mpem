<?php

class M_annees extends MY_Model{
	public $id_annees;
	public $libelle_annees;
	public $etat_annees;


	public function verif_annee($libelle_annees){
		return $this->db->select('*')
			->from($this->get_db_table())
			->where('libelle_annees', $libelle_annees)
			->get()
			->row();
	}

	public function custom_update(){
		$result = $this->db
			->where('id_annees', $this->id_annees)
			->update($this->get_db_table(), [
				'libelle_annees' => $this->libelle_annees,
				'etat_annees' => $this->etat_annees,
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
			->where($this->get_db_table_pk(), $this->id_annees)
			->update($this->get_db_table(), [$this->get_db_table_etat() => '0']);

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
			return $this->db->select("an.*")
				->from($this->get_db_table() . ' as an')
				->where('an.etat_annees !="0"')
				->order_by("etat_annees, libelle_annees", "desc")
				->get()
				->result();
		else {
			return $this->db->select("an.*")
				->from($this->get_db_table() . ' as an')
				->where('str.code_str', $_SESSION['code_str_session'])
				->where('an.etat_annees !="0"')
				->order_by("etat_annees, libelle_annees", "desc")
				->get()
				->result();
		}
	}

	public function get_db_table(){
		return 'annees';
	}

	public function get_db_table_pk(){
		return 'id_annees';
	}

	public function get_db_table_etat(){
		return 'etat_annees';
	}
}
