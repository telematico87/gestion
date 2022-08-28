<?php 
namespace App\Models;
use CodeIgniter\Model;

class PurchaseModel extends Model {

	public function readPurchases(){
		$results = $this->db
		->table('purchase p')
		->select('p.id, p.total, p.date, s.name as supplier, v.name as voucher')
		->join('supplier s','s.id=p.supplier_id')
		->join('voucher v','v.id=p.voucher_id')
		->get()
		->getResultObject();

		return $results;
    }

	public function readProducts(){
		$results = $this->db
		->table('product')
		->select('id, name, price_purchase as pricepurchase, price_sale as pricesale')
		->where('barcode !=','')
		->get()
		->getResultArray();

		return $results;
    }

	public function readSuppliers(){
		$results = $this->db
		->table('supplier')
		->select('id, name, ruc')
		->get()
		->getResultArray();

		return json_encode($results);
    }

    public function createPurchase($data){
		$this->db
		->table('purchase')
		->set($data)
		->insert();

		return $this->db->insertID();
	}

	public function createPurchaseDetails($data){
		$this->db
		->table('purchase_detail')
		->set($data)
		->insert();
	}

	public function updateProduct($id, $cant, $pricePurchase, $priceSale){
		$this->db
		->table('product')
		->set('stock', 'stock+'.$cant, false)
		->set('price_purchase', $pricePurchase)
		->set('price_sale', $priceSale)
		->where('id', $id)
		->update();
	}
}