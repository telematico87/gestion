<?php

namespace App\Controllers\Product;
use CodeIgniter\Controller;
use App\Models\ProductModel;
use Config\Services;

class Main extends Controller
{
	public function index()
	{
		$productModel = new ProductModel();
        $data["products"] = $productModel->readProducts();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Product/main', $data);
		echo view('Layout/footer');
		echo view('js/product');
	}

	public function delete($id){
		$productModel = new ProductModel();
		$session = Services::session();
		
        if($productModel->deleteProduct($id)==1){
			$session->setFlashdata('success', 'Los datos se eliminaron correctamente');
		} else {
			$session->setFlashdata('error', 'No puedes eliminar un producto en uso!');
		}

		return redirect()->to('/producto');
	}
}