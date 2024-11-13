<?php 
namespace App\Controllers;
use App\Models\M_publications;
use CodeIgniter\Controller;
class C_publications extends Controller
{
    
    public function index()
    {
    $model = new M_publications();
    // pagination
    
    echo view('actualites', $data);
    }

}
