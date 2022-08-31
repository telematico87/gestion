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
			'type_document' => 'required',
			'num_document' => 'required|is_unique[client.num_document]',
			'phone_number' => 'numeric|max_length[12]',
			'address' => 'max_length[80]']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"name" => $this->request->getVar("name"),
				"type_document" => $this->request->getVar("type_document"),
				"num_document" => $this->request->getVar("num_document"),
				"phone_number" => $this->request->getVar("phone_number"),
				"email" => $this->request->getVar("email"),
				"type_operator" => $this->request->getVar("type_operator"),
				"place_birth" => $this->request->getVar("place_birth"),
				"fecha_nacimiento" => $this->request->getVar("fecha_nacimiento"),
				"responsible" => $this->request->getVar("responsible"),
				"madre" => $this->request->getVar("madre"),
				"padre" => $this->request->getVar("padre"),
				"bussines_name" => $this->request->getVar("bussines_name"),
				"fecha_emision" => $this->request->getVar("fecha_emision"),
				"representante" => $this->request->getVar("representante"),
				"dni_representante" => $this->request->getVar("dni_representante"),
				"address_install" => $this->request->getVar("address_install"),
				"type_service" => $this->request->getVar("type_service"),
				"recomienda" => $this->request->getVar("recomienda"),
				"district" => $this->request->getVar("district"),
				"department" => $this->request->getVar("department"),
				"province" => $this->request->getVar("province"),
				"address_rf" => $this->request->getVar("address_rf"),
				"address_billing" => $this->request->getVar("address_rf"),
				"contact_phone" => $this->request->getVar("contact_phone"),
				"email_notification" => $this->request->getVar("email_notification"),
				"address_notification" => $this->request->getVar("address_notification"),
				"fecha_emision_facturacion" => $this->request->getVar("fecha_emision_facturacion"),
				"fecha_vencimiento_facturacion" => $this->request->getVar("fecha_vencimiento_facturacion"),

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

		if($numdocument!=$this->request->getVar("num_document")){
			$validateDocument = '|is_unique[client.num_document]';
		}

		$validation = $this->validate([
			'name' => 'required',
		  	'type_document' => 'required',
		  	'num_document' => 'required'.$validateDocument,
		  	'phone_number' => 'numeric|max_length[12]',
		  	//'email' => 'required|valid_email',
		  	'address' => 'max_length[80]']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				"name" => $this->request->getVar("name"),
				"type_document" => $this->request->getVar("type_document"),
				"num_document" => $this->request->getVar("num_document"),
				"phone_number" => $this->request->getVar("phone_number"),
				"email" => $this->request->getVar("email"),
				"type_operator" => $this->request->getVar("type_operator"),
				"place_birth" => $this->request->getVar("place_birth"),
				"fecha_nacimiento" => $this->request->getVar("fecha_nacimiento"),
				"responsible" => $this->request->getVar("responsible"),
				"madre" => $this->request->getVar("madre"),
				"padre" => $this->request->getVar("padre"),
				"bussines_name" => $this->request->getVar("bussines_name"),
				"fecha_emision" => $this->request->getVar("fecha_emision"),
				"representante" => $this->request->getVar("representante"),
				"dni_representante" => $this->request->getVar("dni_representante"),
				"address_install" => $this->request->getVar("address_install"),
				"type_service" => $this->request->getVar("type_service"),
				"recomienda" => $this->request->getVar("recomienda"),
				"district" => $this->request->getVar("district"),
				"department" => $this->request->getVar("department"),
				"province" => $this->request->getVar("province"),
				"address_rf" => $this->request->getVar("address_rf"),
				"address_billing" => $this->request->getVar("address_rf"),
				"contact_phone" => $this->request->getVar("contact_phone"),
				"email_notification" => $this->request->getVar("email_notification"),
				"address_notification" => $this->request->getVar("address_notification"),
				"fecha_emision_facturacion" => $this->request->getVar("fecha_emision_facturacion"),
				"fecha_vencimiento_facturacion" => $this->request->getVar("fecha_vencimiento_facturacion"),

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