<?php
class M_sys_profil extends MY_Model
{
	public $id_type_profil;
	public $libelle_type_profil;
	public $etat;

	private $insert_role = '';
	private $update_role = '';

	public function get_db_table(){
		return 'sys_type_profil';;
	}

	public function get_db_table_pk(){
		return 'id_type_profil';
	}

	public function get_db_table_etat(){
		return 'etat';
	}

	public function fake_delete(){
		$result = $this->db
			->where($this->get_db_table_pk(), $this->id_type_profil)
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

	// PERF: remove unused method
	// In the controller (the `index` method), we are using `get_data()`
	public function get_data_liste(){
		$sql = "SELECT * FROM sys_type_profil WHERE etat='1'";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
