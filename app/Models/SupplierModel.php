<?php 
namespace App\Models;
use CodeIgniter\Model;

class SupplierModel extends Model {

	public function readSuppliers(){
		$results = $this->db
		->table('supplier')
		->get()
		->getResultArray();

		return json_encode($results);
    }

	public function readSupplier($id){
		$results = $this->db
		->table('supplier')
		->where('id', $id)
		->get()
		->getRowObject();

		return $results;
    }

    public function createSupplier($data){
		$this->db
		->table('supplier')
		->set($data)
		->insert();
	}

	public function updateSupplier($id, $data){
		$this->db
		->table('supplier')
		->set($data)
		->where('id', $id)
		->update();
	}

	public function deleteSupplier($id){
		$this->db
		->table('supplier')
		->where('id', $id)
		->delete();

		return $this->db->affectedRows();
	}

}