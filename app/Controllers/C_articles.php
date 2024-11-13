<?php 
namespace App\Controllers;
use App\Models\M_articles;
use CodeIgniter\Controller;
class C_articles extends Controller
{
    
    public function index()
    {
    $model = new M_articles();
    // pagination
    echo view('actualites', $data);
    }

}