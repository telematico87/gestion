<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CategoryModel;

class Category extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
	protected $request;

	public function index()
	{
		$categoryModel = new CategoryModel();
        $data["categorys"] = $categoryModel->readCategorys();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('category', $data);
		echo view('Layout/footer');
		echo view('Js/category');
	}

	public function getData(){
		$categoryModel = new CategoryModel();
        echo $categoryModel->readCategorys();
	}

	public function save()
	{
		$categoryModel = new CategoryModel();

		$validation = $this->validate([
      		'name' => 'required|is_unique[category.name]',
			'description' => 'required']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"name" => $this->request->getVar("name"),
				"description" => $this->request->getVar("description")
			];

			$categoryModel->createCategory($data);
			$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function update()
	{
		$categoryModel = new CategoryModel();
		$id = $this->request->getVar("id");
		$name = $categoryModel->readCategory($id)->name;
		$validateName = '';

		IF($name!=$this->request->getVar("name")){
			$validateName = '|is_unique[category.name]';
		}

		$validation = $this->validate([
      		'name' => 'required'.$validateName,
			'description' => 'required']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"name" => $this->request->getVar("name"),
				"description" => $this->request->getVar("description")
			];

			$categoryModel->updateCategory($id, $data);
			$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function delete(){
		$id = $this->request->getVar("id");
		$categoryModel = new CategoryModel();

        if($categoryModel->deleteCategory($id)==1){
			$response = ['type' => "success", 'message' => "Los datos se eliminaron correctamente!"];
		} else {
			$response = ['type' => "error", 'message' => "No puedes eliminar una categoria en uso!"];
		}
		
		echo json_encode($response);
	}
}