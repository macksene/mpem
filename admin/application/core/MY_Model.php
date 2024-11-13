<?php

require_once 'application/core/MY_Model_Interface.php';

abstract class MY_Model extends CI_Model implements MY_Model_Interface{

	function __construct($db_select = null){
		parent::__construct();
		//Load them in the constructor

		if (empty($db_select))
			$db_string = $this->select_db();
		else
			$db_string = $db_select;

		$this->db = $this->load->database($db_string, TRUE);
	}

	public function select_db(){
		return 'default';
	}


	public function fake_delete(){
		$this->db->where($this->get_db_table_pk(), $this->{$this->get_db_table_pk()});
		$this->db->update($this->get_db_table(), array($this->get_db_table_etat() => '-1'));

		if ($this->db->trans_status() === FALSE) {
			$status = 'error';
			$result = 'Error! ID [' . $this->{$this->get_db_table_pk()} . '] not found';
		} else {
			$status = 'success';
			$result = 'Suppression effectuée avec succées.';
		}

		$d = array();
		$d['status'] = $status;
		$d['message'] = $result;

		return $d;
	}

	public function restor(){
		$this->db->where($this->get_db_table_pk(), $this->{$this->get_db_table_pk()});
		$this->db->update($this->get_db_table(), array($this->get_db_table_etat() => '1'));

		if ($this->db->trans_status() === FALSE) {
			$status = 'error';
			$result = 'Error! ID [' . $this->{$this->get_db_table_pk()} . '] not found';
		} else {
			$status = 'success';
			$result = 'Restauration effectuée avec succées.';
		}

		$d = array();
		$d['status'] = $status;
		$d['message'] = $result;

		return $d;
	}

	public function get_etat($code){
		$sql = "SELECT " . $this->get_db_table_etat() . " 
               FROM " . $this->get_db_table() . " 
               WHERE " . $this->get_db_table_pk() . " ='" . $code . "'";

		$query = $this->db->query($sql);
		return array_values($query->row_array());
	}

	private function insert(){
		$this->db->insert($this->get_db_table(), $this);
		if (!empty($this->get_db_table_pk())) {
			$this->{$this->get_db_table_pk()} = $this->db->insert_id();
			return $this->{$this->get_db_table_pk()};
		} else {
			return '';
		}
	}

	private function update(){
		$this->db->update($this->get_db_table(), $this, array(
			$this->get_db_table_pk() => $this->{$this->get_db_table_pk()}
		));

		return $this->{$this->get_db_table_pk()};
	}

	public function save(){
		if (isset($this->{$this->get_db_table_pk()}) && !empty($this->get_db_table_pk())) {
			$id = $this->update();
		} else {
			$id = $this->insert();
		}

		if ($this->db->trans_status() === FALSE) {
			$status = 'error';
			$result = 'Erreur d\'enregistrement.';
		} else {
			$status = 'success';
			$result = 'Enregistrement effectué avec succées.';
		}

		$d = array();
		$d['id'] = $id;
		$d['status'] = $status;
		$d['message'] = $result;

		return $d;
	}

	//ingored null
	private function insert_without_null(){
		foreach ($this as $key => $value) {
			if ($value ==  null && $key != $this->{$this->get_db_table_pk()})
				unset($this->$key);
		}
		$this->db->insert($this->get_db_table(), $this);
		$this->{$this->get_db_table_pk()} = $this->db->insert_id();
		return $this->{$this->get_db_table_pk()};
	}

	private function update_without_null(){
		foreach ($this as $key => $value) {
			if ($value ==  null && $key != $this->{$this->get_db_table_pk()})
				unset($this->$key);
		}
		$this->db->update($this->get_db_table(), $this, array(
			$this->get_db_table_pk() => $this->{$this->get_db_table_pk()}
		));
		return $this->{$this->get_db_table_pk()};
	}

	public function save_without_null(){
		if (isset($this->{$this->get_db_table_pk()})) {
			$id = $this->update_without_null();
		} else {
			$id = $this->insert_without_null();
		}

		if ($this->db->trans_status() === FALSE) {
			$status = 'error';
			$result = 'Erreur d\'enregistrement.';
		} else {
			$status = 'success';
			$result = 'Enregistrement effectué avec succées.';
		}

		$d = array();
		$d['id'] = $id;
		$d['status'] = $status;
		$d['message'] = $result;

		return $d;
	}

	public function delete(){
		$this->db->delete($this->get_db_table(), array($this->get_db_table_pk() => $this->{$this->get_db_table_pk()}));
		if ($this->db->trans_status() === FALSE) {
			$status = 'error';
			$result = 'Error! ID [' . $this->{$this->get_db_table_pk()} . '] not found';
		} else {
			$status = 'success';
			$result = 'Suppression effectuée avec succées.';
		}

		$d = array();
		$d['status'] = $status;
		$d['message'] = $result;

		return $d;
	}

	public function get_data(){
		return $this->db->select('*')
			->from($this->get_db_table())
			->get()
			->result();
	}

	public function get_active_data(){
		if ($this->get_db_table_etat()) {
			return $this->db->select('*')
				->from($this->get_db_table())
				->where($this->get_db_table_etat(), '1')
				->get()
				->result();
		} else {
			$this->get_active_data();
		}
	}

	public function get_record(){
		$row = $this->db->select('*')
			->from($this->get_db_table())
			->where($this->get_db_table_pk(), $this->{$this->get_db_table_pk()})
			->get()
			->result();
		$row = reset($row);

		if ($row == null)
			$this->{$this->get_db_table_pk()} = null;
		else
			foreach ($row as $param => $value) {
				$this->{$param} = $value;
			}
	}

	public function get_active_record(){
		$row = $this->db->select('*')
			->from($this->get_db_table())
			->where($this->get_db_table_pk(), $this->{$this->get_db_table_pk()})
			->where($this->get_db_table_etat(), '1')
			->get()
			->result();
		$row = reset($row);

		if ($row == null)
			$this->{$this->get_db_table_pk()} = null;
		else
			foreach ($row as $param => $value) {
				$this->{$param} = $value;
			}
	}

	public function get_id_(){
		return $this->db->select('*')
			->from($this->get_vf_table())
			->where($this->get_vf_table_pk(), $this->{$this->get_vf_table_pk()})
			->get()
			->result();
	}

	public function check_unique_field($table, $col_name, $val_to_search, $extraWhere = null){

		$sql = "SELECT $col_name FROM $table WHERE $col_name='" . trim($val_to_search) . "'";

		if ($extraWhere != null && $extraWhere != '')

			$sql .= " AND $extraWhere";

		$row = $this->db->query($sql)->row();

		if (!empty($row)) {

			$d = array();

			$d['status'] = 'error';

			$d['message'] = "La valeur " . $val_to_search . " existe déjà.";

			echo json_encode($d, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

			exit();

			die();
		}
	}
}
