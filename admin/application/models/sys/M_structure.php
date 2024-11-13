<?php

class M_structure extends MY_Model{
	public $code_str;
	public $categorie;
	public $sigle_str;
	public $libelle;
	public $email_str;
	public $tel_str;
	public $etat_str;


	public function verif_structure($libelle){
		return $this->db->select('*')
			->from($this->get_db_table())
			->where('libelle', $libelle)
			->get()
			->row();
	}

	public function custom_update(){
		$result = $this->db
			->where('code_str', $this->code_str)
			->update($this->get_db_table(), [
				'code_str' => $this->code_str,
				'libelle' => $this->libelle,
				'categorie' => $this->categorie,
				'sigle_str' => $this->sigle_str,
				'email_str' => $this->email_str,
				'tel_str' => $this->tel_str,
				'etat_str' => $this->etat_str,
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
			->where($this->get_db_table_pk(), $this->code_str)
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
			return $this->db->select("str.*")
				->from($this->get_db_table() . ' as str')
				->where('str.etat_str !="0"')
				->order_by("etat_str, libelle", "desc")
				->get()
				->result();
		else {
			return $this->db->select("str.*")
				->from($this->get_db_table() . ' as str')
				->where('str.code_str', $_SESSION['code_str_session'])
				->where('str.etat_str !="0"')
				->order_by("etat_str, libelle", "desc")
				->get()
				->result();
		}
	}

	public function get_db_table(){
		return 'structure';
	}

	public function get_db_table_pk(){
		return 'code_str';
	}

	public function get_db_table_etat(){
		return 'etat_str';
	}
}
