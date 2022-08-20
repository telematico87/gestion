<?php 
namespace App\Models;
use CodeIgniter\Model;

class PurchaseDetailModel extends Model {

	public function readPurchase($id){
		$results = $this->db
		->table('purchase p')
		->select('p.id, p.subtotal, p.igv, p.total, p.date, s.name as supplier, v.name as voucher, s.phone_number, s.ruc, s.email')
		->join('supplier s','s.id=p.supplier_id')
		->join('voucher v','v.id=p.voucher_id')
		->where('p.id', $id)
		->get()
		->getRowObject();

		return $results;
    }

	public function readPurchaseDetails($id){
		$results = $this->db
		->table('purchase_detail d')
		->select('d.cant, d.amount, p.name as product, p.price_purchase as pricepurchase')
		->join('product p','p.id=d.product_id')
		->where('d.purchase_id', $id)
		->get()
		->getResultObject();

		return $results;
    }
}