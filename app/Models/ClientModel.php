<?php 
namespace App\Models;
use CodeIgniter\Model;

class ClientModel extends Model {

	public function readClients(){
		$results = $this->db
		->table('client')
		->get()
		->getResultArray();

		return json_encode($results);
    }

	public function readClient($id){
		$results = $this->db
		->table('client')
		->where('id', $id)
		->get()
		->getRowObject();

		return $results;
    }

    public function createClient($data){
		$create=$this->db
		->table('client')
		->set($data)
		->insert();
	}

	public function updateClient($id, $data){
		$this->db
		->table('client')
		->set($data)
		->where('id', $id)
		->update();
	}

	public function deleteClient($id){
		$this->db
		->table('client')
		->where('id', $id)
		->delete();

		return $this->db->affectedRows();
	}

}