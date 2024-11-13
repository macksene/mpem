<?php
class M_sys_user extends MY_Model
{

	public $id;
	public $matricule;
	public $id_profil;
	public $code_acces;
	public $statut;

	/**
	 * Get the `id` of `M_sys_user` using the matricule
	 * 
	 * @param string $matricule matricule of the user
	 * @return string The id of the `sys_user`
	 */
	public function get_id_by_matricule($matricule){
		$rslt = $this->db->select('id')
			->from($this->get_db_table())
			->where('matricule', $matricule)
			->get()
			->row();

		// TODO: refac this, there is a helper function for returning the fields
		return $rslt->id;
	}

	/**
	 * Update the `profil` and `statut` of the user
	 *
	 */
	public function custom_update(){
		$result = $this->db
			->where('id', $this->id)
			->update($this->get_db_table(), [
				'id_profil' => $this->id_profil,
				'statut' => $this->statut
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

	// PERF: refactor this and the method above ☝️
	public function fake_delete(){
		$result = $this->db
			->where($this->get_db_table_pk(), $this->id)
			->update($this->get_db_table(), ['statut' => '0']);

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
			return $this->db->select("usr.id as id_sys, usr.statut, pers_str.*, ssp.*")
				->from($this->get_db_table() . ' as usr')
				->join('personnel as pers_str', 'pers_str.matricule = usr.matricule')
				->join('sys_type_profil as ssp', 'ssp.id_type_profil = usr.id_profil')
				->where('usr.statut !="0"')
				->order_by("statut, matricule", "asc")
				->get()
				->result();
		else {
			return $this->db->select("usr.*, pers_str.*, ssp.*")
				->from($this->get_db_table() . ' as usr')
				->join('personnel as pers_str', 'pers_str.matricule = usr.matricule')
				->join('sys_type_profil as ssp', 'ssp.id_type_profil = usr.id_profil')
				->where('pers_str.code_str', $_SESSION['code_str_session'])
				->get()
				->result();
		}
	}

	public function verif_matricule(){
		$sql = "SELECT * FROM personnel_structure AS pers_str 
        WHERE pers_str.matricule_personnel = '" . $this->matricule . "'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	/**
	 * Verifie si une personne existe dans la table `sys_user`
	 *
	 * @param string $matricule matricule of the user
	 * @return object Les informations concernant la personne
	 */
	public function verif_matriculeusr($matricule){
		return $this->db->select('*')
			->from('sys_user')
			->where('matricule', $matricule)
			->get()
			->row();
	}

	/**
	 * Verifie si une personne existe dans la table `personnel`
	 *
	 * @param string $matricule matricule of the user
	 * @return object Les informations concernant la personne
	 */
	public function verif_matriculepers($matricule){
		return $this->db->select('*')
			->from('personnel')
			->where('matricule', $matricule)
			->get()
			->row();
	}

	public function get_db_table(){
		return 'sys_user';
	}

	public function get_db_table_pk(){
		return 'id';
	}

	public function get_db_table_etat(){
		return 'etat';
	}
}
