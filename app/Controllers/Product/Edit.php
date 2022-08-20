<?php

namespace App\Controllers\Product;
use CodeIgniter\Controller;
use App\Models\ProductModel;
use Config\Services;

class Edit extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
    protected $request;

	public function index($id)
	{

		$productModel = new ProductModel();
		$product = $productModel->readProduct($id);
		$categories = $productModel->readCategories();
		$session = Services::session();
		$session->set("idProduct", $product->id);

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Product/edit', ['product' => $product, 'categories' => $categories]);
		echo view('Layout/footer');
		echo view('js/product');
	}

	public function save()
	{
		$productModel = new ProductModel();
		$session = Services::session();
		$id = $session->get('idProduct');
		$name = $productModel->readProduct($id)->name;
		
		$validateName = null;

		IF($name!=$this->request->getVar("name")){
			$validateName = '|is_unique[product.name]';
		}

		$validation = $this->validate([
            'barcode' => 'required|integer',
			'category' => 'required',
            'name' => 'required'.$validateName,
			'description' => 'required'
        ]);

		if(!$validation){
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"barcode" => $this->request->getVar("barcode"),
				"category_id" => $this->request->getVar("category"),
				"name" => $this->request->getVar("name"),
				"description" => $this->request->getVar("description"),
				"modified_at" => date("Y-m-d h:i:s")
			];
			
			$productModel->createProduct($id, $data);
            $session->setFlashdata("success", "Los datos se actualizaron correctamente!");
    
            echo json_encode("success");
		}
	}
}