<?php

namespace App\Controllers\Product;
use CodeIgniter\Controller;
use App\Models\ProductModel;
use Config\Services;

class Add extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
    protected $request;
	protected $helpers = ["form"];

	public function index()
	{
		$productModel = new ProductModel();
		$session = Services::session();
		$idUser = 1;
		$productAdd = $productModel->checkProduct($idUser);

		if($productAdd){
			$session->set("idProduct", $productAdd->id);
		} else {
			$session->set("idProduct", $productModel->newProduct(["name" => $idUser]));
		}

		$data['categories'] = $productModel->readCategories();
		
		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Product/add', $data);
		echo view('Layout/footer');
		echo view('js/product');
	}

	public function save()
	{
		$productModel = new ProductModel();
		$session = Services::session();

		$validation = $this->validate([
            'barcode' => 'required|integer',
			'category' => 'required',
            'name' => 'required|is_unique[product.name]',
			'description' => 'required'
        ]);

		if(!$validation){
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"barcode" => $this->request->getVar("barcode"),
				"category_id" => $this->request->getVar("category"),
				"name" => $this->request->getVar("name"),
				"description" => $this->request->getVar("description")
			];
			
			$productModel->createProduct($session->get('idProduct'), $data);
            $session->setFlashdata("success", "Los datos se guardaron correctamente!");
    
            echo json_encode("success");
		}
	}
	
	public function uploadFile()
	{
		$productModel = new ProductModel();

		$validationRule = [
            'productfile' => [
                'label' => 'Upload files',
                'rules' => 'uploaded[productfile]|max_size[productfile,2000]|mime_in[productfile,image/jpg,image/pjpeg,image/jpeg,image/png]'
            ],
        ];

        if (!$this->validate($validationRule)) {
            $response = ['type' => "error", 'message' => $this->validator->getError()];
			echo json_encode($response);
        } else {
			$session = Services::session();
			$file = $this->request->getFile('productfile');
			$idUser = $session->get('idProduct');
			$name = hash('haval128,5', $idUser).'.'.$file->getClientExtension();

			$file->move('./assets/img/product', $name, true);
			$productModel->createProduct($idUser, ['picture' => base_Url('assets/img/product/'.$name)]);

			$response = ['type' => "success", 'message' => "El archivo se subió correctamente."];
			echo json_encode($response);
		}
	}
}