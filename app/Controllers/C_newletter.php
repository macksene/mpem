<?php 
namespace App\Controllers;
use App\Models\M_newletter;
use CodeIgniter\Controller;
class C_newletter extends Controller
{
    public function index()
    {
        $model = new M_newletter();
        $data['newletter'] = $model->getNewletter();
        echo view('accueil',$data);
    }

    public function addNewletter()
    {
        echo view('accueil');
    }

    public function save()
    {
        $model = new M_newletter();
        $data = array(
            'email'  => $this->request->getPost('email'),
        );
        $model->saveNewletter($data);
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
