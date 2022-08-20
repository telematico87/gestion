<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ClientModel;

class Client extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
	protected $request;

	public function index()
	{
		$clientModel = new ClientModel();
        $data["clients"] = $clientModel->readClients();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('client', $data);
		echo view('Layout/footer');
		echo view('Js/client');
	}

	public function getData(){
		$clientModel = new ClientModel();
        echo $clientModel->readClients();
	}

	public function save()
	{
		$clientModel = new ClientModel();

		$validation = $this->validate([
      		'name' => 'required',
			'typedocument' => 'required',
			'numdocument' => 'required|is_natural|max_length[15]|is_unique[client.num_document]',
			'phonenumber' => 'numeric|max_length[12]',
			'email' => 'required|valid_email',
			'address' => 'max_length[80]']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"name" => $this->request->getVar("name"),
				"type_document" => $this->request->getVar("typedocument"),
				"num_document" => $this->request->getVar("numdocument"),
				"phone_number" => $this->request->getVar("phonenumber"),
				"email" => $this->request->getVar("email"),
				"address" => $this->request->getVar("address")
			];

			$clientModel->createClient($data);
			$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function update()
	{
		$clientModel = new ClientModel();
		$id = $this->request->getVar("id");
		$numdocument = $clientModel->readClient($id)->num_document;
		$validateDocument = '';

		if($numdocument!=$this->request->getVar("numdocument")){
			$validateDocument = '|is_unique[client.num_document]';
		}

		$validation = $this->validate([
			'name' => 'required',
		  	'typedocument' => 'required',
		  	'numdocument' => 'required'.$validateDocument,
		  	'phonenumber' => 'numeric|max_length[12]',
		  	'email' => 'required|valid_email',
		  	'address' => 'max_length[80]']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"name" => $this->request->getVar("name"),
				"type_document" => $this->request->getVar("typedocument"),
				"num_document" => $this->request->getVar("numdocument"),
				"phone_number" => $this->request->getVar("phonenumber"),
				"email" => $this->request->getVar("email"),
				"address" => $this->request->getVar("address")
			];

			$clientModel->updateClient($id, $data);
			$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function delete(){
		$id = $this->request->getVar("id");
		$clientModel = new ClientModel();

        if($clientModel->deleteClient($id)==1){
			$response = ['type' => "success", 'message' => "Los datos se eliminaron correctamente!"];
		} else {
			$response = ['type' => "error", 'message' => "No puedes eliminar una cliente activo!"];
		}
		
		echo json_encode($response);
	}
}