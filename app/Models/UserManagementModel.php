<?php 
namespace App\Models;
use CodeIgniter\Model;

class UserManagementModel extends Model {

	public function readUsers(){
		$results = $this->db
		->table('users')
		->select('id, email, username, full_name as fullname, phone_number as phonenumber, picture')
		->get()
		->getResultArray();

		return json_encode($results);
    }

	public function readUser($id){
		$results = $this->db
		->table('users')
		->select('id, email, username, full_name as fullname, phone_number as phonenumber, picture')
		->where('id', $id)
		->get()
		->getRowObject();

		return $results;
    }

    public function createUser($data){
		$this->db
		->table('users')
		->set($data)
		->insert();
	}

	public function updateUser($id, $data){
		$this->db
		->table('users')
		->set($data)
		->where('id', $id)
		->update();
	}

	public function deleteUser($id){
		$this->db
		->table('users')
		->where('id', $id)
		->delete();

		return $this->db->affectedRows();
	}

}