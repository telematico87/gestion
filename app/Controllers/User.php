<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserManagementModel;
use Fluent\Auth\Facades\Hash;

class User extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
	protected $request;

	public function index()
	{
		$userManagementModel = new UserManagementModel();
        $data["users"] = $userManagementModel->readUsers();

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('user', $data);
		echo view('Layout/footer');
		echo view('Js/user');
	}

	public function getData(){
		$userManagementModel = new UserManagementModel();
        echo $userManagementModel->readUsers();
	}

	public function save()
	{
		$userManagementModel = new UserManagementModel();

		$validation = $this->validate([
			'fullname' => 'required',
			'username' => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
			'email' => 'required|valid_email|is_unique[users.email]',
			'password' => 'required|min_length[8]',
			'passwordconfirmation' => 'matches[password]',
			'phonenumber' => 'numeric|min_length[8]|max_length[15]']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {

			$data = [
				'username' => $this->request->getVar("username"),
				'email' => $this->request->getVar("email"),
				'password' => Hash::make($this->request->getVar("password")),
				'full_name' => $this->request->getVar("fullname"),
				'phone_number' => $this->request->getVar("phonenumber"),
				'picture' => base_Url('assets/img/profile/user.jpg')
			];

			$userManagementModel->createUser($data);
			$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function update()
	{
		$userManagementModel = new UserManagementModel();
		$id = $this->request->getVar("id");
		$user = $userManagementModel->readUser($id);
		$validateUsername = '';
		$validateEmail = '';

		if($user->username!=$this->request->getVar("username")){
			$validateUsername = '|is_unique[users.username]';
		}

		if($user->email!=$this->request->getVar("email")){
			$validateEmail = '|is_unique[users.email]';
		}

		$validation = $this->validate([
			'fullname' => 'required',
            'username' => 'required|alpha_numeric_space|min_length[3]'.$validateUsername,
            'email' => 'required|valid_email'.$validateEmail,
            'password' => 'required|min_length[8]',
            'passwordconfirmation' => 'matches[password]',
			'phonenumber' => 'numeric|min_length[8]|max_length[15]']);

		if(!$validation){ 
			echo json_encode($this->validator->getErrors());
		} else {
			
			$data = [
				'username' => $this->request->getVar("username"),
				'email' => $this->request->getVar("email"),
				'password' => Hash::make($this->request->getVar("password")),
				'full_name' => $this->request->getVar("fullname"),
				'phone_number' => $this->request->getVar("phonenumber")
			];

			$userManagementModel->updateUser($id, $data);
			$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
			echo json_encode($response);
		}
	}

	public function delete(){
		$id = $this->request->getVar("id");
		$userManagementModel = new UserManagementModel();

        if($userManagementModel->deleteUser($id)==1){
			$response = ['type' => "success", 'message' => "Los datos se eliminaron correctamente!"];
		} else {
			$response = ['type' => "error", 'message' => "No puedes eliminar un usuario asignado!"];
		}
		
		echo json_encode($response);
	}
}