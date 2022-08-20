<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProfileModel extends Model {

	public function readUser($id){
		$results = $this->db
		->table('users')
		->select('id, full_name as fullname, phone_number as phonenumber, address')
		->where('id', $id)
		->get()
		->getRowObject();

		return $results;
    }

	public function updateUser($id, $data){
		$this->db
		->table('users')
		->set($data)
		->where('id', $id)
		->update();
	}
}