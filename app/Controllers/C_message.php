<?php 
namespace App\Controllers;
use App\Models\M_message;
use CodeIgniter\Controller;
class C_message extends Controller
{
    public function index()
    {
        $model = new M_message();
        $data['message'] = $model->getMessage();
        echo view('accueil',$data);
    }

    public function addMessage()
    {
        echo view('accueil');
    }

    public function save()
    {
        $model = new M_message();
        $data = array(
            'prenom'  => $this->request->getPost('prenom'),
            'nom'  => $this->request->getPost('nom'),
            'email'  => $this->request->getPost('email'),
            'objet'  => $this->request->getPost('objet'),
            'message'  => $this->request->getPost('message'),
        );
        $model->saveMessage($data);
        return redirect()->to('/');
    }

    // public function edit($id)
    // {
    //     $model = new Product_model();
    //     $data['product'] = $model->getProduct($id)->getRow();
    //     echo view('edit_product_view', $data);
    // }

    // public function update()
    // {
    //     $model = new Product_model();
    //     $id = $this->request->getPost('product_id');
    //     $data = array(
    //         'product_name'  => $this->request->getPost('product_name'),
    //         'product_price' => $this->request->getPost('product_price'),
    //     );
    //     $model->updateProduct($data, $id);
    //     return redirect()->to('/product');
    // }

    // public function delete($id)
    // {
    //     $model = new Product_model();
    //     $model->deleteProduct($id);
    //     return redirect()->to('/product');
    // }
}
