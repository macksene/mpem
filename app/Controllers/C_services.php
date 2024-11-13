<?php 
namespace App\Controllers;
use App\Models\M_services;
use CodeIgniter\Controller;
class C_services extends Controller
{
    
    public function index()
    {
    $model = new M_services();
    // pagination
    
    echo view('licence', $data);
    }

}
