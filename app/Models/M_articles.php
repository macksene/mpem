<?php namespace App\Models;

use CodeIgniter\Model;
 
class M_articles extends Model{
    protected $table = 'articles';

    public function getArticles(){
    
        return $this->select('*')                             
        ->orderBy('id_articles', 'DESC')->findAll();
    }
 }
?>