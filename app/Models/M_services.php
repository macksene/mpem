<?php namespace App\Models;

use CodeIgniter\Model;
 
class M_services extends Model{
    protected $table = 'services';

    public function getServices(){
    
        return $this->select('*')                             
        ->orderBy('id_services', 'DESC')->findAll();
    }

 }
?>
