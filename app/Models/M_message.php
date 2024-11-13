<?php namespace App\Models;

use CodeIgniter\Model;
 
class M_message extends Model{
    protected $table = 'message';
    // protected $primaryKey = 'id_message';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    // protected $allowedFields = ['email'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'date_creation';
    // protected $updatedField  = 'date_modification';
    // protected $deletedField  = 'date_suppression';



    public function getMessage($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id_message' => $id]);
        }   
    }

    public function saveMessage($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    // public function updateMessage($data, $id)
    // {
    //     $query = $this->db->table($this->table)->update($data, array('id_message' => $id));
    //     return $query;
    // }

    // public function deleteMessage($id)
    // {
    //     $query = $this->db->table($this->table)->delete(array('id_message' => $id));
    //     return $query;
    // }   
 }
?>