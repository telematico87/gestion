<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SupplierModel;

class Supplier extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
	protected $request;

	public function index()
	{
		$supplierModel = new SupplierModel();
        $data["suppliers"] = $supplierModel->readSuppliers();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('supplier', $data);
		echo view('Layout/footer');
		echo view('Js/supplier');
	}

	public function getData(){
		$supplierModel = new SupplierModel();
        echo $supplierModel->readSuppliers();
	}

	public function save()
	{
		$supplierModel = new SupplierModel();

		$validation = $this->validate([
      		'name' => 'required|is_unique[supplier.name]',
			'ruc' => 'required|numeric|min_length[10]|max_length[15]',
			'phonenumber' => 'required|numeric|max_length[12]',
			'email' => 'required|valid_email']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"name" => $this->request->getVar("name"),
				"ruc" => $this->request->getVar("ruc"),
				"phone_number" => $this->request->getVar("phonenumber"),
				"email" => $this->request->getVar("email")
			];

			$supplierModel->createSupplier($data);
			$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function update()
	{
		$supplierModel = new SupplierModel();
		$id = $this->request->getVar("id");
		$name = $supplierModel->readSupplier($id)->name;
		$validateName = '';

		IF($name!=$this->request->getVar("name")){
			$validateName = '|is_unique[supplier.name]';
		}

		$validation = $this->validate([
      		'name' => 'required'.$validateName,
			'ruc' => 'required|numeric|min_length[10]|max_length[15]',
			'phonenumber' => 'required|numeric|max_length[12]',
			'email' => 'required|valid_email']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"name" => $this->request->getVar("name"),
				"ruc" => $this->request->getVar("ruc"),
				"phone_number" => $this->request->getVar("phonenumber"),
				"email" => $this->request->getVar("email")
			];

			$supplierModel->updateSupplier($id, $data);
			$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function delete(){
		$id = $this->request->getVar("id");
		$supplierModel = new SupplierModel();

        if($supplierModel->deleteSupplier($id)==1){
			$response = ['type' => "success", 'message' => "Los datos se eliminaron correctamente!"];
		} else {
			$response = ['type' => "error", 'message' => "No puedes eliminar un proveedor en uso!"];
		}
		
		echo json_encode($response);
	}
}