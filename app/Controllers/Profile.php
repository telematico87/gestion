<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use CodeIgniter\Controller;

class Profile extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
  protected $request;

	public function index()
	{
		echo view('layout/head');
		echo view('layout/aside');
		echo view('profile');
		echo view('layout/footer');
		echo view('js/profile');
	}

	public function getData()
	{
		$profileModel = new ProfileModel();
		$response = $profileModel->readUser(auth()->user()->id);
		echo json_encode($response);
	}

	public function save()
	{
		$profileModel = new ProfileModel();

		$validation = $this->validate([
			'fullname' => 'required|max_length[160]',
			'phonenumber' => 'numeric|min_length[8]|max_length[15]',
			'address' => 'max_length[255]']);

		if(!$validation){
			echo json_encode($this->validator->getErrors());
		} else {
			$data = [
				'full_name' => $this->request->getVar("fullname"),
				'phone_number' => $this->request->getVar("phonenumber"),
				'address' => $this->request->getVar("address")
			];

			$profileModel->updateUser(auth()->user()->id, $data);
			$response = ['type' => "success", 'message' => "Los datos se actualizaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function uploadFile()
	{
		$profileModel = new ProfileModel();

		$validationRule = [
            'profilefile' => [
                'label' => 'Upload files',
                'rules' => 'uploaded[profilefile]|max_size[profilefile,2000]|mime_in[profilefile,image/jpg,image/pjpeg,image/jpeg,image/png]'
            ],
        ];

        if (!$this->validate($validationRule)) {
            $response = ['type' => "error", 'message' => $this->validator->getError()];
			echo json_encode($response);
        } else {
			$file = $this->request->getFile('profilefile');
			$name = hash('haval128,5', auth()->user()->id).'.png';

			$file->move('./assets/img/profile', $name, true);
			$profileModel->updateUser(auth()->user()->id, ['picture' => base_Url('assets/img/profile/'.$name)]);
			
			$response = ['type' => "success", 'message' => "El archivo se subió correctamente."];
			echo json_encode($response);
		}
	}
}