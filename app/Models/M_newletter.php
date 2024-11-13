<?php namespace App\Models;

use CodeIgniter\Model;
 
class M_newletter extends Model{
    protected $table = 'newletter';
    // protected $primaryKey = 'id_newletter';

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



    public function getNewletter($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id_newletter' => $id]);
        }   
    }

    public function saveNewletter($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    // public function updateNewletter($data, $id)
    // {
    //     $query = $this->db->table($this->table)->update($data, array('id_newletter' => $id));
    //     return $query;
    // }

    // public function deleteNewletter($id)
    // {
    //     $query = $this->db->table($this->table)->delete(array('id_newletter' => $id));
    //     return $query;
    // }   
 }
?>