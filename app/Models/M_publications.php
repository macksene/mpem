<?php namespace App\Models;

use CodeIgniter\Model;
 
class M_publications extends Model{
    protected $table = 'publications';

    public function getPublications(){
    
        return $this->select('*')                             
        ->orderBy('id_publications', 'DESC')->findAll();
    }

 }
?>
