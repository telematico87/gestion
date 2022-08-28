<?php 
namespace App\Models;
use CodeIgniter\Model;

class CategoryModel extends Model {

	public function readCategorys(){
		$results = $this->db
		->table('category c')
		->select('c.id, c.name, c.description')
		->get()
		->getResultArray();

		return json_encode($results);
    }

	public function readCategory($id){
		$results = $this->db
		->table('category')
		->where('id', $id)
		->get()
		->getRowObject();

		return $results;
    }

    public function createCategory($data){
		$this->db
		->table('category')
		->set($data)
		->insert();
	}

	public function updateCategory($id, $data){
		$this->db
		->table('category')
		->set($data)
		->where('id', $id)
		->update();
	}

	public function deleteCategory($id){
		$this->db
		->table('category')
		->where('id', $id)
		->delete();

		return $this->db->affectedRows();
	}

}